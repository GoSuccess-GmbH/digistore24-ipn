<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Tests\Unit\Util;

use DateTimeImmutable;
use GoSuccess\Digistore24\Ipn\Enum\Event;
use GoSuccess\Digistore24\Ipn\Notification;
use GoSuccess\Digistore24\Ipn\Util\NotificationSerializer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(NotificationSerializer::class)]
final class NotificationSerializerTest extends TestCase
{
    #[Test]
    public function it_converts_enums_to_their_scalar_value(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;

        self::assertSame('on_payment', NotificationSerializer::toArray($notification)['event']);
    }

    #[Test]
    public function it_converts_datetime_to_iso8601(): void
    {
        $notification = new Notification();
        $notification->order_date = new DateTimeImmutable('2026-06-21 17:20:41', new \DateTimeZone('UTC'));

        $array = NotificationSerializer::toArray($notification);

        self::assertSame('2026-06-21T17:20:41+00:00', $array['order_date']);
    }

    #[Test]
    public function it_keeps_scalar_and_null_values_as_is(): void
    {
        $notification = new Notification();
        $notification->order_id = 'HM5AJLA4';
        $notification->amount_brutto = 99.99;

        $array = NotificationSerializer::toArray($notification);

        self::assertSame('HM5AJLA4', $array['order_id']);
        self::assertSame(99.99, $array['amount_brutto']);
        self::assertNull($array['email']);
    }

    #[Test]
    public function it_includes_raw_unknown_fields(): void
    {
        $notification = Notification::fromArray([
            'event' => 'on_payment',
            'some_new_ds24_field' => 'raw-value',
        ]);

        self::assertSame('raw-value', NotificationSerializer::toArray($notification)['some_new_ds24_field']);
    }

    #[Test]
    public function it_serializes_to_valid_json(): void
    {
        $notification = new Notification();
        $notification->event = Event::ON_PAYMENT;
        $notification->order_id = 'HM5AJLA4';

        $json = NotificationSerializer::toJson($notification);

        self::assertJson($json);
        $decoded = json_decode($json, true);
        self::assertIsArray($decoded);
        self::assertSame('on_payment', $decoded['event']);
        self::assertSame('HM5AJLA4', $decoded['order_id']);
    }

    #[Test]
    public function it_deserializes_from_json(): void
    {
        $notification = NotificationSerializer::fromJson('{"event":"on_payment","product_id":"123"}');

        self::assertSame(Event::ON_PAYMENT, $notification->event);
        self::assertSame(123, $notification->product_id);
    }

    #[Test]
    public function it_throws_when_json_does_not_decode_to_an_array(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        NotificationSerializer::fromJson('"just a string"');
    }

    #[Test]
    public function it_round_trips_through_json_including_unknown_fields(): void
    {
        $original = Notification::fromArray([
            'event' => 'on_payment',
            'order_id' => 'HM5AJLA4',
            'amount_brutto' => '99.99',
            'brand_new_field' => 'keep-me',
        ]);

        $restored = NotificationSerializer::fromJson(NotificationSerializer::toJson($original));

        self::assertSame(Event::ON_PAYMENT, $restored->event);
        self::assertSame('HM5AJLA4', $restored->order_id);
        self::assertSame(99.99, $restored->amount_brutto);
        self::assertSame('keep-me', $restored->getDynamicFields()['brand_new_field']);
    }
}
