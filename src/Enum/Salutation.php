<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Enum;

/**
 * Enum representing salutation types in the Digistore24 IPN system.
 *
 * This enum defines the salutation values used for address fields in Digistore24.
 * These are the exact values sent by Digistore24's IPN API.
 *
 * Usage in Notification:
 * - $notification->address_salutation
 *
 * @example
 * ```php
 * // Check salutation
 * if ($notification->address_salutation === Salutation::MR) {
 *     echo "Sehr geehrter Herr {$notification->address_last_name}";
 * } elseif ($notification->address_salutation === Salutation::MRS) {
 *     echo "Sehr geehrte Frau {$notification->address_last_name}";
 * } else {
 *     echo "Hallo {$notification->address_first_name}";
 * }
 * ```
 */
enum Salutation: string
{
    /**
     * Male salutation (Mr).
     * Digistore24 value: 'M'
     */
    case MR = 'M';

    /**
     * Female salutation (Mrs).
     * Digistore24 value: 'F'
     */
    case MRS = 'F';

    /**
     * No salutation specified.
     * Digistore24 value: '' (empty string)
     */
    case NONE = '';
}
