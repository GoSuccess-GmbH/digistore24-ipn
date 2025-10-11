<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Tests\Integration;

use GoSuccess\Digistore24IPN\Enum\BillingType;
use GoSuccess\Digistore24IPN\Exception\FormatException;
use GoSuccess\Digistore24IPN\Request;
use GoSuccess\Digistore24IPN\Response;
use GoSuccess\Digistore24IPN\Security\Signature;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Integration test for the complete IPN workflow.
 *
 * This test simulates a real-world scenario where:
 * 1. Digistore24 sends an IPN notification
 * 2. We validate the signature
 * 3. We process the request
 * 4. We send back a response
 */
final class IPNWorkflowTest extends TestCase
{
    private const PASSPHRASE = 'test_secret_passphrase_123';

    #[Test]
    public function it_handles_complete_payment_notification_workflow(): void
    {
        // 1. Simulate incoming IPN data from Digistore24
        $ipnData = $this->createSimulatedIPNData();

        // 2. Validate signature
        $this->assertNotNull($ipnData['sha_sign']);
        Signature::validateSignature(self::PASSPHRASE, $ipnData);

        // 3. Parse into Request object
        $request = Request::fromArray($ipnData);

        // 4. Verify request data
        $this->assertSame('on_payment', $request->event->value);
        $this->assertSame('john.doe@example.com', $request->email);
        $this->assertSame(49.99, $request->transaction_amount);

        // 5. Create response
        $response = new Response();
        $response->thankyouUrl = 'https://example.com/thank-you';
        $response->headline = 'Thank you for your purchase!';
        $response->addLoginBlock(
            'john.doe@example.com',
            $this->generateRandomPassword(),
            'https://members.example.com/login'
        );

        // 6. Verify response format
        $responseString = $response->toString();
        $this->assertStringStartsWith('OK', $responseString);
        $this->assertStringContainsString('thankyou_url: https://example.com/thank-you', $responseString);
        $this->assertStringContainsString('username: john.doe@example.com', $responseString);
    }

    #[Test]
    public function it_rejects_tampered_ipn_data(): void
    {
        // 1. Create valid IPN data
        $ipnData = $this->createSimulatedIPNData();

        // 2. Tamper with the data (change amount)
        $ipnData['amount'] = '99.99'; // Changed from 49.99

        // 3. Signature validation should fail
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage('Signature is invalid');

        Signature::validateSignature(self::PASSPHRASE, $ipnData);
    }

    #[Test]
    public function it_handles_refund_notification(): void
    {
        $ipnData = [
            'event' => 'on_refund',
            'product_id' => '123456',
            'order_id' => 'ORD-12345',
            'email' => 'john.doe@example.com',
            'transaction_id' => 'TXN-REF-999',
            'transaction_amount' => '-49.99',
            'currency' => 'EUR',
        ];

        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $ipnData);
        $ipnData['sha_sign'] = $signature;

        // Validate and parse
        Signature::validateSignature(self::PASSPHRASE, $ipnData);
        $request = Request::fromArray($ipnData);

        $this->assertSame('on_refund', $request->event->value);
        $this->assertSame(-49.99, $request->transaction_amount);
    }

    #[Test]
    public function it_handles_subscription_payment(): void
    {
        $ipnData = [
            'event' => 'on_payment',
            'product_id' => '999888',
            'order_id' => 'SUB-67890',
            'email' => 'subscriber@example.com',
            'transaction_id' => 'TXN-SUB-111',
            'transaction_amount' => '29.99',
            'currency' => 'USD',
            'billing_type' => 'subscription',
            'is_first_payment' => '1',
        ];

        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $ipnData);
        $ipnData['sha_sign'] = $signature;

        Signature::validateSignature(self::PASSPHRASE, $ipnData);
        $request = Request::fromArray($ipnData);

        $this->assertSame('subscriber@example.com', $request->email);
        $this->assertSame(BillingType::SUBSCRIPTION, $request->billing_type);
    }

    #[Test]
    public function it_handles_multiple_products_in_order(): void
    {
        $ipnData = [
            'event' => 'on_payment',
            'product_id' => '111',
            'product_ids' => '111,222,333',
            'order_id' => 'MULTI-99999',
            'email' => 'buyer@example.com',
            'transaction_id' => 'TXN-MULTI-555',
            'transaction_amount' => '149.97',
            'currency' => 'EUR',
        ];

        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $ipnData);
        $ipnData['sha_sign'] = $signature;

        Signature::validateSignature(self::PASSPHRASE, $ipnData);
        $request = Request::fromArray($ipnData);

        // product_ids is a comma-separated string from Digistore24
        $this->assertSame('111,222,333', $request->product_ids);
        
        // Can be split into array if needed
        $productArray = explode(',', $request->product_ids);
        $this->assertSame(['111', '222', '333'], $productArray);
    }

    #[Test]
    public function it_creates_multi_login_response(): void
    {
        $ipnData = $this->createSimulatedIPNData();
        
        Signature::validateSignature(self::PASSPHRASE, $ipnData);
        $request = Request::fromArray($ipnData);

        // Create response with multiple login accounts
        $response = new Response();
        $response->thankyouUrl = 'https://example.com/welcome';
        $response->headline = 'Your accounts are ready!';

        // Add multiple login blocks (e.g., for different services)
        $response->addLoginBlock(
            'john.doe@example.com',
            'pass1_abc123',
            'https://service1.example.com/login'
        );
        $response->addLoginBlock(
            'john.doe',
            'pass2_xyz789',
            'https://service2.example.com/login'
        );
        $response->addLoginBlock(
            'johndoe',
            'pass3_qwe456',
            'https://service3.example.com/login'
        );

        $responseString = $response->toString();

        $this->assertStringContainsString('username: john.doe@example.com', $responseString);
        $this->assertStringContainsString('username_2: john.doe', $responseString);
        $this->assertStringContainsString('username_3: johndoe', $responseString);
    }

    #[Test]
    public function it_handles_custom_fields_in_response(): void
    {
        $ipnData = $this->createSimulatedIPNData();
        
        Signature::validateSignature(self::PASSPHRASE, $ipnData);
        $request = Request::fromArray($ipnData);

        $response = new Response();
        $response->thankyouUrl = 'https://example.com/thanks';
        $response->addLoginBlock('user', 'pass', 'https://example.com/login');
        
        // Add custom fields
        $response->setAdditionalData('order_reference', $request->order_id ?? 'N/A');
        $response->setAdditionalData('customer_id', 'CUST-12345');
        $response->setAdditionalData('support_email', 'help@example.com');
        $response->setAdditionalData('activation_date', date('Y-m-d'));

        $responseString = $response->toString();

        $this->assertStringContainsString('order_reference:', $responseString);
        $this->assertStringContainsString('customer_id: CUST-12345', $responseString);
        $this->assertStringContainsString('support_email: help@example.com', $responseString);
        $this->assertStringContainsString('activation_date:', $responseString);
    }

    #[Test]
    public function it_handles_unicode_buyer_data(): void
    {
        $ipnData = [
            'event' => 'on_payment',
            'product_id' => '123456',
            'order_id' => 'ORD-UNICODE-1',
            'email' => 'günther.müller@example.de',
            'address_first_name' => 'Günther',
            'address_last_name' => 'Müller',
            'address_city' => 'München',
            'transaction_id' => 'TXN-UNI-123',
            'transaction_amount' => '79.99',
            'currency' => 'EUR',
        ];

        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $ipnData);
        $ipnData['sha_sign'] = $signature;

        Signature::validateSignature(self::PASSPHRASE, $ipnData);
        $request = Request::fromArray($ipnData);

        $this->assertSame('Günther', $request->address_first_name);
        $this->assertSame('Müller', $request->address_last_name);
        $this->assertSame('München', $request->address_city);
    }

    #[Test]
    public function it_validates_minimum_required_fields(): void
    {
        $ipnData = [
            'event' => 'on_payment',
            'product_id' => '123',
            'order_id' => 'ORD-MIN-1',
            'email' => 'minimal@example.com',
        ];

        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $ipnData);
        $ipnData['sha_sign'] = $signature;

        Signature::validateSignature(self::PASSPHRASE, $ipnData);
        $request = Request::fromArray($ipnData);

        $this->assertSame('on_payment', $request->event->value);
        $this->assertSame(123, $request->product_id); // Should be int after type casting
        $this->assertSame('ORD-MIN-1', $request->order_id);
        $this->assertSame('minimal@example.com', $request->email);
    }

    /**
     * Create simulated IPN data with signature
     */
    private function createSimulatedIPNData(): array
    {
        $data = [
            'event' => 'on_payment',
            'product_id' => '123456',
            'order_id' => 'ORD-12345',
            'email' => 'john.doe@example.com',
            'address_first_name' => 'John',
            'address_last_name' => 'Doe',
            'transaction_id' => 'TXN-999888',
            'transaction_amount' => '49.99',
            'currency' => 'EUR',
            'pay_method' => 'creditcard',
        ];

        $signature = Signature::getExpectedSignature(self::PASSPHRASE, $data);
        $data['sha_sign'] = $signature;

        return $data;
    }

    /**
     * Generate a random secure password
     */
    private function generateRandomPassword(int $length = 16): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*';
        $password = '';
        $max = strlen($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, $max)];
        }

        return $password;
    }
}
