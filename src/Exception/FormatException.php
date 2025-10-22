<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24\Ipn\Exception;

use InvalidArgumentException;

/**
 * Exception thrown when IPN data format is invalid.
 *
 * This exception indicates that the IPN request or response data does not
 * conform to the expected Digistore24 format or validation rules.
 *
 * Common scenarios:
 * - Invalid URL format in Response::$thankyouUrl
 * - Missing required fields in login blocks
 * - Invalid or missing signature in IPN data
 * - Reserved key names used in additional data
 * - Empty passphrase or parameters in signature validation
 *
 * @example
 * ```php
 * try {
 *     $response->thankyouUrl = 'not-a-valid-url';
 * } catch (FormatException $e) {
 *     echo $e->getMessage(); // "Invalid URL format: not-a-valid-url"
 * }
 * ```
 */
class FormatException extends InvalidArgumentException
{
}
