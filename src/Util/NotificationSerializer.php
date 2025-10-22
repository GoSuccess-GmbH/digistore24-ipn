<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Util;

use BackedEnum;
use DateTimeImmutable;
use GoSuccess\Digistore24\Ipn\Notification;
use JsonException;

/**
 * Serializer utility for Notification objects.
 *
 * This class provides serialization and deserialization logic for IPN notifications,
 * supporting conversion between Notification objects and array/JSON formats.
 */
final class NotificationSerializer
{
    /**
     * Prevent instantiation of utility class.
     */
    private function __construct()
    {
    }

    /**
     * Convert notification to array.
     *
     * Returns all properties as an associative array, converting objects
     * to their string representations (Enums → value, DateTime → ISO 8601 string).
     *
     * @param Notification $notification The notification to convert
     *
     * @return array<string, mixed> Notification data as array
     *
     * @example
     * ```php
     * $notification = Notification::fromPost();
     * $array = NotificationSerializer::toArray($notification);
     *
     * // Store in cache/queue
     * file_put_contents('cache.json', json_encode($array));
     * ```
     */
    public static function toArray(Notification $notification): array
    {
        $data = [];

        foreach (get_object_vars($notification) as $property => $value) {
            // Convert enums to their scalar values
            if ($value instanceof BackedEnum) {
                $data[$property] = $value->value;
            }
            // Convert DateTimeImmutable to ISO 8601 string
            elseif ($value instanceof DateTimeImmutable) {
                $data[$property] = $value->format('c');
            }
            // Keep everything else as-is
            else {
                $data[$property] = $value;
            }
        }

        return $data;
    }

    /**
     * Convert notification to JSON string.
     *
     * @param Notification $notification The notification to convert
     *
     * @return string JSON representation of the notification
     *
     * @throws JsonException If JSON encoding fails
     *
     * @example
     * ```php
     * $notification = Notification::fromPost();
     * $json = NotificationSerializer::toJson($notification);
     *
     * // Send to queue system
     * $redis->rpush('ipn_queue', $json);
     * ```
     */
    public static function toJson(Notification $notification): string
    {
        return json_encode(self::toArray($notification), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
    }

    /**
     * Create notification from JSON string.
     *
     * @param string $json JSON string representing notification data
     *
     * @return Notification New Notification instance
     *
     * @throws JsonException If JSON decoding fails
     *
     * @example
     * ```php
     * // Retrieve from queue
     * $json = $redis->lpop('ipn_queue');
     * $notification = NotificationSerializer::fromJson($json);
     *
     * // Process notification
     * if ($notification->isPayment()) {
     *     // Grant access
     * }
     * ```
     */
    public static function fromJson(string $json): Notification
    {
        $data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        return Notification::fromArray($data);
    }
}
