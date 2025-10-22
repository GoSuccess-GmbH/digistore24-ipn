<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Tests\Unit;

use GoSuccess\Digistore24\Ipn\Enum\BillingStatus;
use GoSuccess\Digistore24\Ipn\Enum\Event;
use GoSuccess\Digistore24\Ipn\Enum\OrderType;
use GoSuccess\Digistore24\Ipn\Enum\TransactionType;
use GoSuccess\Digistore24\Ipn\Notification;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(Notification::class)]
final class NotificationTest extends TestCase
{
    // Convenience method tests

    #[Test]
    public function it_detects_payment_event(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;

        $this->assertTrue($notification->isPayment());
        $this->assertFalse($notification->isRefund());
        $this->assertFalse($notification->isChargeback());
    }

    #[Test]
    public function it_detects_refund_event(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_REFUND;

        $this->assertTrue($notification->isRefund());
        $this->assertFalse($notification->isPayment());
        $this->assertFalse($notification->isChargeback());
    }

    #[Test]
    public function it_detects_chargeback_event(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_CHARGEBACK;

        $this->assertTrue($notification->isChargeback());
        $this->assertFalse($notification->isPayment());
        $this->assertFalse($notification->isRefund());
    }

    #[Test]
    public function it_detects_payment_missed_event(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT_MISSED;

        $this->assertTrue($notification->isPaymentMissed());
        $this->assertFalse($notification->isPayment());
    }

    #[Test]
    public function it_detects_rebill_cancelled_event(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_REBILL_CANCELLED;

        $this->assertTrue($notification->isRebillCancelled());
        $this->assertFalse($notification->isPayment());
    }

    #[Test]
    public function it_detects_rebill_resumed_event(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_REBILL_RESUMED;

        $this->assertTrue($notification->isRebillResumed());
        $this->assertFalse($notification->isRebillCancelled());
    }

    #[Test]
    public function it_detects_affiliation_event(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_AFFILIATION;

        $this->assertTrue($notification->isAffiliation());
        $this->assertFalse($notification->isPayment());
    }

    #[Test]
    public function it_returns_false_for_null_event(): void
    {
        $notification = new Notification();
        $notification->event = null;

        $this->assertFalse($notification->isPayment());
        $this->assertFalse($notification->isRefund());
        $this->assertFalse($notification->isChargeback());
    }

    // Validation method tests

    #[Test]
    public function it_validates_successfully_with_all_fields(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->email = 'customer@example.com';
        $notification->order_id = '12345';
        $notification->product_id = 67890;
        $notification->amount_brutto = 99.99;
        $notification->amount_netto = 84.99;
        $notification->transaction_amount = 104.99;

        $errors = $notification->validate();

        $this->assertEmpty($errors);
    }

    #[Test]
    public function it_detects_missing_event(): void
    {
        $notification = new Notification();
        $notification->email = 'test@example.com';

        $errors = $notification->validate();

        $this->assertContains('event field is required', $errors);
    }

    #[Test]
    public function it_detects_invalid_email_format(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->email = 'invalid-email';

        $errors = $notification->validate();

        $this->assertContains('Invalid email format: invalid-email', $errors);
    }

    #[Test]
    public function it_detects_negative_amount(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->amount_brutto = -10.50;

        $errors = $notification->validate();

        $this->assertContains('amount_brutto must not be negative: -10.5', $errors);
    }

    #[Test]
    public function it_detects_negative_order_id(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->order_id = '-123';

        $errors = $notification->validate();

        $this->assertContains('order_id must be positive: -123', $errors);
    }

    #[Test]
    public function it_detects_negative_product_id(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->product_id = -456;

        $errors = $notification->validate();

        $this->assertContains('product_id must be positive: -456', $errors);
    }

    #[Test]
    public function it_detects_multiple_validation_errors(): void
    {
        $notification = new Notification();
        $notification->email = 'invalid';
        $notification->amount_brutto = -50.0;
        $notification->order_id = '-100';

        $errors = $notification->validate();

        $this->assertGreaterThanOrEqual(3, count($errors));
        $this->assertContains('event field is required', $errors);
    }

    #[Test]
    public function it_accepts_null_email(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->email = null;

        $errors = $notification->validate();

        $this->assertEmpty($errors);
    }

    #[Test]
    public function it_accepts_null_amounts(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->amount_brutto = null;
        $notification->amount_netto = null;

        $errors = $notification->validate();

        $this->assertEmpty($errors);
    }

    // Serialization method tests

    #[Test]
    public function it_serializes_to_array(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->order_id = '12345';
        $notification->product_id = 67890;
        $notification->email = 'customer@example.com';

        $array = $notification->toArray();

        $this->assertSame('on_payment', $array['event']);
        $this->assertSame('12345', $array['order_id']);
        $this->assertSame(67890, $array['product_id']);
        $this->assertSame('customer@example.com', $array['email']);
    }

    #[Test]
    public function it_converts_enums_to_scalar_values(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->order_type = OrderType::REGULAR;
        $notification->billing_status = BillingStatus::COMPLETED;
        $notification->transaction_type = TransactionType::PAYMENT;

        $array = $notification->toArray();

        $this->assertSame('on_payment', $array['event']);
        $this->assertSame('regular', $array['order_type']);
        $this->assertSame('completed', $array['billing_status']);
        $this->assertSame('payment', $array['transaction_type']);
    }

    #[Test]
    public function it_converts_datetime_to_iso8601(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->order_date = new \DateTimeImmutable('2025-01-15 10:30:00');

        $array = $notification->toArray();

        $this->assertIsString($array['order_date']);
        $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}/', $array['order_date']);
    }

    #[Test]
    public function it_serializes_to_json(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->order_id = '12345';

        $json = $notification->toJson();

        $this->assertJson($json);
        $decoded = json_decode($json, true);
        $this->assertIsArray($decoded);
        $this->assertSame('on_payment', $decoded['event']);
        $this->assertSame('12345', $decoded['order_id']);
    }

    #[Test]
    public function it_deserializes_from_json(): void
    {
        $json = (string) json_encode([
            'event' => 'on_payment',
            'order_id' => '12345',
            'product_id' => 67890,
            'email' => 'test@example.com',
            'amount_brutto' => 99.99,
        ]);

        $notification = Notification::fromJson($json);

        $this->assertInstanceOf(Notification::class, $notification);
        $this->assertSame(Event::ON_PAYMENT, $notification->event);
        $this->assertSame('12345', $notification->order_id);
        $this->assertSame(67890, $notification->product_id);
        $this->assertSame('test@example.com', $notification->email);
        $this->assertSame(99.99, $notification->amount_brutto);
    }

    #[Test]
    public function it_handles_null_values_in_serialization(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->email = null;
        $notification->order_id = null;

        $array = $notification->toArray();

        $this->assertNull($array['email']);
        $this->assertNull($array['order_id']);
    }

    #[Test]
    public function it_roundtrips_through_json(): void
    {
        $original = new Notification();
        $original->event = Event::ON_PAYMENT;
        $original->order_id = '12345';
        $original->email = 'test@example.com';
        $original->amount_brutto = 99.99;

        $json = $original->toJson();
        $deserialized = Notification::fromJson($json);

        $this->assertEquals($original->event, $deserialized->event);
        $this->assertEquals($original->order_id, $deserialized->order_id);
        $this->assertEquals($original->email, $deserialized->email);
        $this->assertEquals($original->amount_brutto, $deserialized->amount_brutto);
    }
}
