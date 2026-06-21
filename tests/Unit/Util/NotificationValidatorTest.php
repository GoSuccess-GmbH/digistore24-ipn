<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Tests\Unit\Util;

use GoSuccess\Digistore24\Ipn\Enum\Event;
use GoSuccess\Digistore24\Ipn\Notification;
use GoSuccess\Digistore24\Ipn\Util\NotificationValidator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(NotificationValidator::class)]
final class NotificationValidatorTest extends TestCase
{
    private function validNotification(): Notification
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->email = 'customer@example.com';
        $notification->amount_brutto = 99.99;
        $notification->product_id = 12345;

        return $notification;
    }

    #[Test]
    public function it_passes_for_a_valid_notification(): void
    {
        self::assertSame([], NotificationValidator::validate($this->validNotification()));
    }

    #[Test]
    public function it_requires_the_event_field(): void
    {
        $notification = new Notification();
        $notification->email = 'customer@example.com';

        self::assertContains('event field is required', NotificationValidator::validate($notification));
    }

    #[Test]
    public function it_rejects_an_invalid_email(): void
    {
        $notification = $this->validNotification();
        $notification->email = 'not-an-email';

        self::assertContains(
            'Invalid email format: not-an-email',
            NotificationValidator::validate($notification)
        );
    }

    #[Test]
    public function it_accepts_a_null_email(): void
    {
        $notification = $this->validNotification();
        $notification->email = null;

        self::assertSame([], NotificationValidator::validate($notification));
    }

    #[Test]
    public function it_rejects_negative_amounts(): void
    {
        $notification = $this->validNotification();
        $notification->amount_brutto = -1.0;
        $notification->transaction_amount = -49.99;

        $errors = NotificationValidator::validate($notification);

        self::assertContains('amount_brutto must not be negative: -1', $errors);
        self::assertContains('transaction_amount must not be negative: -49.99', $errors);
    }

    #[Test]
    public function it_allows_zero_amounts(): void
    {
        $notification = $this->validNotification();
        $notification->amount_brutto = 0.0;

        self::assertSame([], NotificationValidator::validate($notification));
    }

    #[Test]
    public function it_rejects_a_non_positive_product_id(): void
    {
        $notification = $this->validNotification();
        $notification->product_id = 0;

        self::assertContains('product_id must be positive: 0', NotificationValidator::validate($notification));
    }

    #[Test]
    public function it_accepts_an_alphanumeric_order_id(): void
    {
        // Digistore24 order ids are strings such as "HM5AJLA4"; they must not be validated numerically.
        $notification = $this->validNotification();
        $notification->order_id = 'HM5AJLA4';

        self::assertSame([], NotificationValidator::validate($notification));
    }
}
