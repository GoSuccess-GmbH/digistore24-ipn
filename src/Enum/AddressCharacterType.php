<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Enum;

/**
 * Enum representing character types for addresses.
 *
 * This enum defines the character types that can be used in addresses,
 * such as UTF-8 and Latin.
 */
enum AddressCharacterType: string
{
    /**
     * UTF-8 character encoding.
     */
    case UTF_8 = 'UTF-8';

    /**
     * Latin character encoding.
     */
    case LATIN = 'Latin';
}
