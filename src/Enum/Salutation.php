<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Enum;

/**
 * Enum representing salutation types in the Digistore24 IPN system.
 *
 * This enum defines the salutation values that can be used for addresses,
 * as specified by the Digistore24 API.
 */
enum Salutation: string
{
    /**
     * Salutation for Mr (male).
     */
    case MR = 'M';

    /**
     * Salutation for Mrs (female).
     */
    case MRS = 'F';

    /**
     * No salutation specified (empty string).
     */
    case NONE = '';
}
