<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

use GoSuccess\Digistore24\Ipn\Contract\StringBackedEnum;
use GoSuccess\Digistore24\Ipn\Trait\StringBackedEnumTrait;

/**
 * Enum representing character types for addresses.
 *
 * This enum defines the character types that can be used in addresses,
 * such as UTF-8 and Latin.
 */
enum AddressCharacterType: string implements StringBackedEnum
{
    use StringBackedEnumTrait;

    /**
     * UTF-8 character encoding.
     */
    case UTF_8 = 'UTF-8';

    /**
     * Latin character encoding.
     */
    case LATIN = 'Latin';

    public function label(): string
    {
        return match ($this) {
            self::UTF_8 => 'UTF-8',
            self::LATIN => 'Latin',
        };
    }
}
