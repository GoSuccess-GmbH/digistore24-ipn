<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Trait;

/**
 * Int-Backed Enum Trait
 *
 * Provides default implementations for IntBackedEnum interface methods.
 * Automatically handles conversion and validation for integer-backed enums.
 *
 * Requirements:
 * - Enum must be backed by int
 * - Enum must implement IntBackedEnum interface
 * - Enum must implement label() method (cannot be provided by trait)
 *
 * @phpstan-ignore trait.unused
 */
trait IntBackedEnumTrait
{
    /**
     * Create enum instance from integer value
     *
     * @param int|null $value The integer value to convert
     *
     * @return static|null The corresponding enum case or null if invalid
     */
    public static function fromInt(?int $value): ?static
    {
        if ($value === null) {
            return null;
        }

        foreach (static::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }

        return null;
    }

    /**
     * Check if an integer value is valid for this enum
     *
     * @param int|null $value The value to validate
     *
     * @return bool True if valid, false otherwise
     */
    public static function isValid(?int $value): bool
    {
        return self::fromInt($value) !== null;
    }

    /**
     * Get all valid integer values for this enum
     *
     * @return array<int, int> Array of all enum values
     */
    public static function values(): array
    {
        return array_map(
            static fn (self $case): int => $case->value,
            static::cases()
        );
    }

    /**
     * Get all labels mapped by their enum values
     *
     * @return array<int, string> Map of value => label
     */
    public static function labels(): array
    {
        $labels = [];

        foreach (static::cases() as $case) {
            $labels[$case->value] = $case->label();
        }

        return $labels;
    }
}
