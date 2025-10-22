<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Util;

use GoSuccess\Digistore24\Ipn\Notification;

/**
 * Validator utility for Notification objects.
 *
 * This class provides validation logic for IPN notification data
 * to check for business logic errors and data integrity issues.
 */
final class NotificationValidator
{
    /**
     * Prevent instantiation of utility class.
     */
    private function __construct()
    {
    }

    /**
     * Validate notification data for business logic errors.
     *
     * This method checks for common data integrity issues that could indicate
     * problems with the IPN data, even if the signature is valid.
     *
     * Validation checks:
     * - Email format validation
     * - Non-negative monetary amounts
     * - Positive order ID
     * - Positive product ID
     * - Required event field
     *
     * @param Notification $notification The notification to validate
     *
     * @return array<string> Array of error messages (empty array if valid)
     *
     * @example
     * ```php
     * $notification = Notification::fromPost();
     * $errors = NotificationValidator::validate($notification);
     *
     * if (!empty($errors)) {
     *     foreach ($errors as $error) {
     *         error_log("Validation error: $error");
     *     }
     *     http_response_code(400);
     *     exit('Invalid data');
     * }
     * ```
     */
    public static function validate(Notification $notification): array
    {
        $errors = [];

        // Validate email format if present
        if ($notification->email !== null && !filter_var($notification->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format: {$notification->email}";
        }

        // Validate monetary amounts are not negative
        $amountFields = [
            'amount_brutto',
            'amount_netto',
            'amount_affiliate',
            'amount_credited',
            'amount_fee',
            'amount_partner',
            'amount_payout',
            'amount_provider',
            'transaction_amount',
        ];

        foreach ($amountFields as $field) {
            $value = $notification->$field;
            if ($value !== null && $value < 0) {
                $errors[] = "{$field} must not be negative: {$value}";
            }
        }

        // Validate order_id is positive if present
        if ($notification->order_id !== null && $notification->order_id <= 0) {
            $errors[] = "order_id must be positive: {$notification->order_id}";
        }

        // Validate product_id is positive if present
        if ($notification->product_id !== null && $notification->product_id <= 0) {
            $errors[] = "product_id must be positive: {$notification->product_id}";
        }

        // Validate event is set (required field)
        if ($notification->event === null) {
            $errors[] = 'event field is required';
        }

        return $errors;
    }
}
