<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Util;

use BackedEnum;
use DateTimeImmutable;
use Exception;

/**
 * Utility class for type conversions in Property Hooks.
 *
 * This class provides static conversion methods for PHP 8.4 Property Hooks
 * to handle Digistore24 IPN data types consistently across all properties.
 *
 * Digistore24 sends all data as strings, but we need proper PHP types.
 * This class handles the conversion with proper null handling.
 */
final class TypeConverter
{
    /**
     * Prevent instantiation of utility class.
     */
    private function __construct()
    {
    }

    /**
     * Convert value to float or null.
     *
     * @param mixed $value The value to convert (typically string from IPN)
     *
     * @return float|null The converted float value or null
     */
    public static function toFloat(mixed $value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (float) $value;
    }

    /**
     * Convert value to int or null.
     *
     * @param mixed $value The value to convert (typically string from IPN)
     *
     * @return int|null The converted integer value or null
     */
    public static function toInt(mixed $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (int) $value;
    }

    /**
     * Convert value to bool or null following Digistore24 specification.
     *
     * Boolean Values as per DS24 documentation:
     * - TRUE: 1, Y, yes, T, true
     * - FALSE: 0, N, no, F, false
     *
     * @param mixed $value The value to convert
     *
     * @return bool|null The converted boolean value or null
     */
    public static function toBool(mixed $value): ?bool
    {
        if ($value === null || $value === '') {
            return null;
        }

        // Normalize to lowercase string for comparison
        $normalized = is_string($value) ? strtolower(trim($value)) : $value;

        return match ($normalized) {
            // TRUE values
            1, '1', 'y', 'yes', 't', 'true' => true,
            // FALSE values
            0, '0', 'n', 'no', 'f', 'false' => false,
            // Unknown value - return null for safety
            default => null,
        };
    }

    /**
     * Convert value to DateTimeImmutable or null.
     *
     * Digistore24 sends dates in format: "Y-m-d H:i:s" (e.g., "2025-10-22 14:30:00")
     *
     * @param mixed $value The value to convert (typically string from IPN)
     *
     * @return DateTimeImmutable|null The converted DateTimeImmutable or null
     */
    public static function toDateTime(mixed $value): ?DateTimeImmutable
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof DateTimeImmutable) {
            return $value;
        }

        // Try parsing the value as ISO 8601 or standard date format
        return new DateTimeImmutable((string) $value);
    }

    /**
     * Convert value to Enum case or null.
     *
     * @template T of BackedEnum
     *
     * @param class-string<T> $enumClass The enum class to convert to
     * @param mixed $value The value to convert (typically string from IPN)
     *
     * @return T|null The enum case or null
     */
    public static function toEnum(string $enumClass, mixed $value): ?BackedEnum
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof $enumClass) {
            return $value;
        }

        try {
            return $enumClass::from($value);
        } catch (Exception) {
            // Invalid enum value - return null
            return null;
        }
    }

    /**
     * Convert comma-separated string to array.
     *
     * Used for tags property and similar comma-delimited fields.
     *
     * @param mixed $value The value to convert (typically comma-separated string)
     *
     * @return array<string> Array of trimmed, non-empty values
     */
    public static function toArray(mixed $value): array
    {
        if ($value === null || $value === '') {
            return [];
        }

        if (is_array($value)) {
            return $value;
        }

        // Split by comma and filter empty values
        $parts = explode(',', (string) $value);
        $trimmed = array_map('trim', $parts);

        return array_filter($trimmed, fn ($item) => $item !== '');
    }
}
