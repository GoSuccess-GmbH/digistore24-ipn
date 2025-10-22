<?php

/**
 * Testing IPN Notifications - Mocking and Unit Test Examples
 *
 * This example shows how to:
 * - Create test IPN notifications
 * - Mock IPN data for unit tests
 * - Test event handlers
 * - Validate business logic
 * - Test signature generation
 */

declare(strict_types=1);

use GoSuccess\Digistore24\Ipn\Enum\BillingStatus;
use GoSuccess\Digistore24\Ipn\Enum\Event;
use GoSuccess\Digistore24\Ipn\Enum\OrderType;
use GoSuccess\Digistore24\Ipn\Enum\PayMethod;
use GoSuccess\Digistore24\Ipn\Notification;
use GoSuccess\Digistore24\Ipn\Response;
use GoSuccess\Digistore24\Ipn\Security\Signature;

require_once __DIR__ . '/../vendor/autoload.php';

// Example 1: Creating mock IPN data for testing
echo "=== Example 1: Creating Mock IPN Notifications ===\n\n";

class IPNTestDataFactory
{
    /**
     * Create a complete payment notification for testing
     */
    public static function createPaymentNotification(array $overrides = []): Notification
    {
        $baseData = [
            'event' => 'on_payment',
            'order_id' => 12345,
            'product_id' => 67890,
            'product_name' => 'Test Product',
            'email' => 'test@example.com',
            'buyer_company' => '',
            'address_first_name' => 'John',
            'address_last_name' => 'Doe',
            'address_salutation' => 'M',
            'address_street' => 'Main Street 123',
            'address_city' => 'Test City',
            'address_zipcode' => '12345',
            'address_state' => 'Test State',
            'address_country' => 'DE',
            'amount_brutto' => 49.99,
            'currency' => 'EUR',
            'pay_method' => 'creditcard',
            'is_test' => 'yes',
            'transaction_id' => 'TXN-' . time(),
            'transaction_amount' => 49.99,
            'order_type' => 'order',
            'billing_status' => 'completed',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $data = array_merge($baseData, $overrides);
        return Notification::fromArray($data);
    }

    /**
     * Create a refund notification for testing
     */
    public static function createRefundNotification(int $orderId = 12345): Notification
    {
        return self::createPaymentNotification([
            'event' => 'on_refund',
            'order_id' => $orderId,
        ]);
    }

    /**
     * Create a subscription payment notification
     */
    public static function createSubscriptionNotification(array $overrides = []): Notification
    {
        return self::createPaymentNotification(array_merge([
            'order_type' => 'rebilling',
            'billing_status' => 'active',
        ], $overrides));
    }

    /**
     * Create a payment missed notification
     */
    public static function createPaymentMissedNotification(int $orderId = 12345): Notification
    {
        return self::createPaymentNotification([
            'event' => 'on_payment_missed',
            'order_id' => $orderId,
            'billing_status' => 'payment_missed',
        ]);
    }

    /**
     * Create a connection test notification
     */
    public static function createConnectionTestNotification(): Notification
    {
        return Notification::fromArray([
            'event' => 'connection_test',
        ]);
    }

    /**
     * Create notification with signature for integration tests
     */
    public static function createSignedNotification(string $passphrase, array $overrides = []): array
    {
        $data = [
            'event' => 'on_payment',
            'order_id' => 12345,
            'email' => 'test@example.com',
            'amount_brutto' => 49.99,
        ];

        $data = array_merge($data, $overrides);

        // Generate valid signature
        $signature = Signature::getExpectedSignature($passphrase, $data);
        $data['sha_sign'] = $signature;

        return $data;
    }
}

// Test creating various notifications
$paymentNotification = IPNTestDataFactory::createPaymentNotification();
echo "Payment Notification:\n";
echo "  Order ID: {$paymentNotification->order_id}\n";
echo "  Email: {$paymentNotification->email}\n";
echo "  Amount: {$paymentNotification->amount_brutto} EUR\n";
echo "  Event: {$paymentNotification->event->value}\n\n";

$subscriptionNotification = IPNTestDataFactory::createSubscriptionNotification();
echo "Subscription Notification:\n";
echo "  Order Type: {$subscriptionNotification->order_type->value}\n";
echo "  Billing Status: {$subscriptionNotification->billing_status->value}\n\n";

// Example 2: Unit test patterns
echo "=== Example 2: Unit Test Patterns ===\n\n";

/**
 * Example test class showing how to test IPN handlers
 */
class IPNHandlerTest
{
    private array $processedOrders = [];

    public function testPaymentHandler(): void
    {
        echo "Running: testPaymentHandler\n";

        $notification = IPNTestDataFactory::createPaymentNotification([
            'order_id' => 99999,
            'email' => 'unittest@example.com',
            'amount_brutto' => 99.99,
        ]);

        // Test the handler
        $this->handlePayment($notification);

        // Assertions
        $this->assertEquals(99999, $notification->order_id);
        $this->assertEquals('unittest@example.com', $notification->email);
        $this->assertEquals(99.99, $notification->amount_brutto);
        $this->assertEquals(Event::ON_PAYMENT, $notification->event);

        // Verify order was processed
        $this->assertTrue(in_array(99999, $this->processedOrders));

        echo "  ✓ Payment handler test passed\n\n";
    }

    public function testRefundHandler(): void
    {
        echo "Running: testRefundHandler\n";

        $notification = IPNTestDataFactory::createRefundNotification(88888);

        // Handler should revoke access
        $this->handleRefund($notification);

        // Assertions
        $this->assertEquals(Event::ON_REFUND, $notification->event);
        $this->assertFalse(in_array(88888, $this->processedOrders));

        echo "  ✓ Refund handler test passed\n\n";
    }

    public function testSubscriptionPayment(): void
    {
        echo "Running: testSubscriptionPayment\n";

        $notification = IPNTestDataFactory::createSubscriptionNotification([
            'order_id' => 77777,
        ]);

        // Test subscription logic
        $this->assertEquals(OrderType::REBILLING, $notification->order_type);
        $this->assertEquals(BillingStatus::ACTIVE, $notification->billing_status);

        echo "  ✓ Subscription payment test passed\n\n";
    }

    public function testPaymentMissed(): void
    {
        echo "Running: testPaymentMissed\n";

        $notification = IPNTestDataFactory::createPaymentMissedNotification(66666);

        // Verify event type
        $this->assertEquals(Event::ON_PAYMENT_MISSED, $notification->event);
        $this->assertEquals(BillingStatus::PAYMENT_MISSED, $notification->billing_status);

        echo "  ✓ Payment missed test passed\n\n";
    }

    public function testSignatureValidation(): void
    {
        echo "Running: testSignatureValidation\n";

        $passphrase = 'test-secret-passphrase';

        // Create signed notification
        $signedData = IPNTestDataFactory::createSignedNotification($passphrase, [
            'order_id' => 55555,
            'email' => 'signed@example.com',
        ]);

        // Test signature validation (should not throw)
        try {
            Signature::validateSignature($passphrase, $signedData);
            echo "  ✓ Valid signature accepted\n";
        } catch (Exception $e) {
            echo "  ✗ Valid signature rejected: {$e->getMessage()}\n";
        }

        // Test invalid signature (should throw)
        $signedData['sha_sign'] = 'invalid_signature';
        try {
            Signature::validateSignature($passphrase, $signedData);
            echo "  ✗ Invalid signature accepted (should have been rejected!)\n";
        } catch (Exception $e) {
            echo "  ✓ Invalid signature correctly rejected\n";
        }

        echo "\n";
    }

    public function testConnectionTest(): void
    {
        echo "Running: testConnectionTest\n";

        $notification = IPNTestDataFactory::createConnectionTestNotification();

        $this->assertEquals(Event::CONNECTION_TEST, $notification->event);

        // Connection test should return "OK"
        $response = $this->handleConnectionTest($notification);
        $this->assertEquals('OK', $response);

        echo "  ✓ Connection test passed\n\n";
    }

    // Handler methods (simplified for testing)

    private function handlePayment(Notification $notification): void
    {
        $this->processedOrders[] = $notification->order_id;
        // In real implementation: create account, grant access, etc.
    }

    private function handleRefund(Notification $notification): void
    {
        $key = array_search($notification->order_id, $this->processedOrders);
        if ($key !== false) {
            unset($this->processedOrders[$key]);
        }
        // In real implementation: revoke access, update billing, etc.
    }

    private function handleConnectionTest(Notification $notification): string
    {
        return 'OK';
    }

    // Simple assertion helpers

    private function assertEquals($expected, $actual): void
    {
        if ($expected !== $actual) {
            throw new Exception("Assertion failed: Expected " . var_export($expected, true) . ", got " . var_export($actual, true));
        }
    }

    private function assertTrue(bool $condition): void
    {
        if (!$condition) {
            throw new Exception("Assertion failed: Expected true, got false");
        }
    }

    private function assertFalse(bool $condition): void
    {
        if ($condition) {
            throw new Exception("Assertion failed: Expected false, got true");
        }
    }
}

// Run the tests
$testSuite = new IPNHandlerTest();
$testSuite->testPaymentHandler();
$testSuite->testRefundHandler();
$testSuite->testSubscriptionPayment();
$testSuite->testPaymentMissed();
$testSuite->testSignatureValidation();
$testSuite->testConnectionTest();

// Example 3: Testing with PHPUnit
echo "=== Example 3: PHPUnit Test Class Template ===\n\n";

echo <<<'PHP'
<?php

use PHPUnit\Framework\TestCase;
use GoSuccess\Digistore24\Ipn\Notification;
use GoSuccess\Digistore24\Ipn\Enum\Event;

class IPNHandlerUnitTest extends TestCase
{
    public function testCreatePaymentNotification(): void
    {
        $data = [
            'event' => 'on_payment',
            'order_id' => 12345,
            'email' => 'test@example.com',
            'amount_brutto' => 49.99,
        ];

        $notification = Notification::fromArray($data);

        $this->assertEquals(12345, $notification->order_id);
        $this->assertEquals('test@example.com', $notification->email);
        $this->assertEquals(49.99, $notification->amount_brutto);
        $this->assertEquals(Event::ON_PAYMENT, $notification->event);
    }

    public function testPropertyHooksConversion(): void
    {
        $data = [
            'event' => 'on_payment',
            'is_test' => 'yes',  // String
            'amount_brutto' => '49.99',  // String
            'order_id' => '12345',  // String
        ];

        $notification = Notification::fromArray($data);

        // Test automatic type conversion
        $this->assertIsBool($notification->is_test);
        $this->assertTrue($notification->is_test);
        
        $this->assertIsFloat($notification->amount_brutto);
        $this->assertEquals(49.99, $notification->amount_brutto);
        
        $this->assertIsInt($notification->order_id);
        $this->assertEquals(12345, $notification->order_id);
    }

    public function testTagsArrayConversion(): void
    {
        $data = [
            'event' => 'on_payment',
            'tags' => 'tag1,tag2,tag3',  // Comma-separated string
        ];

        $notification = Notification::fromArray($data);

        $this->assertIsArray($notification->tags);
        $this->assertCount(3, $notification->tags);
        $this->assertEquals(['tag1', 'tag2', 'tag3'], $notification->tags);
    }

    /**
     * @dataProvider paymentDataProvider
     */
    public function testPaymentWithDataProvider(
        int $orderId, 
        string $email, 
        float $amount
    ): void {
        $data = [
            'event' => 'on_payment',
            'order_id' => $orderId,
            'email' => $email,
            'amount_brutto' => $amount,
        ];

        $notification = Notification::fromArray($data);

        $this->assertEquals($orderId, $notification->order_id);
        $this->assertEquals($email, $notification->email);
        $this->assertEquals($amount, $notification->amount_brutto);
    }

    public static function paymentDataProvider(): array
    {
        return [
            'basic payment' => [12345, 'test1@example.com', 49.99],
            'high value' => [12346, 'test2@example.com', 999.99],
            'low value' => [12347, 'test3@example.com', 9.99],
        ];
    }
}
PHP;

echo "\n\n=== Example 4: Mocking External Dependencies ===\n\n";

echo <<<'PHP'
<?php

use PHPUnit\Framework\TestCase;

class IPNHandlerIntegrationTest extends TestCase
{
    private $databaseMock;
    private $emailServiceMock;
    
    protected function setUp(): void
    {
        // Mock database
        $this->databaseMock = $this->createMock(Database::class);
        
        // Mock email service
        $this->emailServiceMock = $this->createMock(EmailService::class);
    }

    public function testPaymentProcessingWithMocks(): void
    {
        // Create test notification
        $notification = Notification::fromArray([
            'event' => 'on_payment',
            'order_id' => 12345,
            'email' => 'test@example.com',
            'amount_brutto' => 49.99,
        ]);

        // Set up mock expectations
        $this->databaseMock
            ->expects($this->once())
            ->method('saveOrder')
            ->with($this->equalTo(12345));

        $this->emailServiceMock
            ->expects($this->once())
            ->method('sendConfirmation')
            ->with($this->equalTo('test@example.com'));

        // Create handler with mocked dependencies
        $handler = new IPNHandler(
            $this->databaseMock,
            $this->emailServiceMock
        );

        // Process notification
        $handler->handlePayment($notification);

        // Assertions are checked by mock expectations
    }
}
PHP;

echo "\n\n=== Summary: Testing Best Practices ===\n\n";
echo "1. ✓ Use factory methods to create consistent test data\n";
echo "2. ✓ Test all event types separately\n";
echo "3. ✓ Test Property Hooks type conversions\n";
echo "4. ✓ Test signature validation (both valid and invalid)\n";
echo "5. ✓ Use data providers for testing multiple scenarios\n";
echo "6. ✓ Mock external dependencies (database, email, APIs)\n";
echo "7. ✓ Test error conditions and exceptions\n";
echo "8. ✓ Test business logic validation\n";
echo "9. ✓ Keep tests isolated and independent\n";
echo "10. ✓ Use descriptive test names\n";
