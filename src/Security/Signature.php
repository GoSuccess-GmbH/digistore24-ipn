<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Security;

use GoSuccess\Digistore24IPN\Exception\FormatException;

/**
 * SHA-512 signature validation and generation for Digistore24 IPN.
 *
 * This class provides cryptographic signature verification to ensure that
 * IPN notifications actually come from Digistore24 and haven't been tampered with.
 * 
 * How it works:
 * 1. Digistore24 sends IPN data with a SHA-512 signature (sha_sign or SHASIGN)
 * 2. You calculate the expected signature using your secret passphrase
 * 3. Compare received signature with expected signature
 * 4. If they match, the data is authentic and untampered
 * 
 * Security Note: ALWAYS validate signatures in production to prevent fraud!
 * 
 * @link https://dev.digistore24.com/hc/en-us/articles/32480217565969-Quick-Integration-Guide
 * 
 * @example
 * ```php
 * // Validate incoming IPN notification
 * Signature::validateSignature('your-secret-passphrase', $_POST);
 * 
 * // Or generate signature for testing
 * $signature = Signature::getExpectedSignature('passphrase', $testData);
 * ```
 */
final class Signature
{
    /**
     * Generates the expected SHA-512 signature for given parameters.
     * 
     * This method creates a signature string by:
     * 1. Removing signature fields (sha_sign, SHASIGN) from parameters
     * 2. Sorting parameter keys alphabetically (optionally uppercase)
     * 3. Filtering out empty/null/false values
     * 4. Building string: KEY=value{passphrase}KEY2=value2{passphrase}...
     * 5. Hashing with SHA-512 and converting to uppercase
     * 
     * The resulting signature proves data integrity and authenticity.
     *
     * @param string $shaPassphrase The secret passphrase from your Digistore24 IPN configuration
     * @param array<string, mixed> $parameters The IPN parameters to sign
     * @param bool $convertKeysToUppercase Whether to convert parameter keys to UPPERCASE before sorting
     * @param bool $doHtmlDecode Whether to HTML-decode parameter values before hashing
     * @return string The calculated SHA-512 signature in uppercase hex format
     * @throws FormatException if passphrase is empty or no parameters provided
     * 
     * @example
     * ```php
     * $params = [
     *     'order_id' => '12345',
     *     'email' => 'test@example.com',
     *     'amount_brutto' => '99.00'
     * ];
     * $signature = Signature::getExpectedSignature('my-secret', $params);
     * ```
     */
    public static function getExpectedSignature(
        string $shaPassphrase,
        array $parameters,
        bool $convertKeysToUppercase = false,
        bool $doHtmlDecode = false
    ): string {
        // Passphrase is required for security
        if ($shaPassphrase === '') {
            throw new FormatException('No signature passphrase provided');
        }

        // Need parameters to sign
        if ($parameters === []) {
            throw new FormatException('No parameters provided for signature calculation');
        }

        // Remove signature fields to avoid circular dependencies
        unset($parameters['sha_sign'], $parameters['SHASIGN']);

        $keys = array_keys($parameters);

        // Prepare keys for sorting (optionally uppercase)
        $keysToSort = $convertKeysToUppercase
            ? array_map(strtoupper(...), $keys)
            : $keys;

        // Sort keys alphabetically while maintaining original key reference
        array_multisort(
            $keysToSort,
            SORT_STRING,
            $keys
        );

        // Build signature string
        $shaString = '';
        foreach ($keys as $key) {
            $value = $parameters[$key];

            // Skip array values (they cannot be used in signature)
            if (is_array($value)) {
                continue;
            }

            // Optionally decode HTML entities in values
            if ($doHtmlDecode && is_string($value)) {
                $value = html_entity_decode($value, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
            }

            // Skip empty/null/false values (they don't contribute to signature)
            if ($value === null || $value === '' || $value === false) {
                continue;
            }

            // Build signature string: KEY=value{passphrase}
            $outKey = $convertKeysToUppercase ? strtoupper($key) : $key;
            $shaString .= "{$outKey}={$value}{$shaPassphrase}";
        }

        // Calculate SHA-512 hash and return uppercase
        return strtoupper(hash('sha512', $shaString));
    }

    /**
     * Validates the received signature against the calculated expected signature.
     * 
     * This method verifies that the IPN data actually comes from Digistore24
     * and hasn't been modified in transit. It's a critical security measure.
     * 
     * The method:
     * 1. Extracts the received signature from data (sha_sign or SHASIGN field)
     * 2. Calculates the expected signature using your passphrase
     * 3. Compares both signatures (must match exactly)
     * 4. Throws exception if signatures don't match or signature is missing
     * 
     * IMPORTANT: Always call this before processing IPN data in production!
     *
     * @param string $shaPassphrase The secret passphrase from your Digistore24 IPN configuration
     * @param array<string, mixed> $data The IPN data including the signature field
     * @param bool $convertKeysToUppercase Whether to convert parameter keys to UPPERCASE
     * @param bool $doHtmlDecode Whether to HTML-decode parameter values
     * @throws FormatException if signature is missing, invalid, or doesn't match
     * 
     * @example
     * ```php
     * // Basic validation
     * try {
     *     Signature::validateSignature('my-secret-passphrase', $_POST);
     *     // Signature is valid, proceed with processing
     * } catch (FormatException $e) {
     *     // Invalid signature - possible fraud attempt
     *     http_response_code(403);
     *     exit('Invalid signature');
     * }
     * ```
     */
    public static function validateSignature(
        string $shaPassphrase,
        array $data,
        bool $convertKeysToUppercase = false,
        bool $doHtmlDecode = false
    ): void {
        // Extract received signature from data (supports both field name variants)
        $receivedSignature = $data['sha_sign']
            ?? $data['SHASIGN']
            ?? throw new FormatException('No signature received.');

        // Calculate what the signature should be
        $expectedSignature = self::getExpectedSignature(
            $shaPassphrase,
            $data,
            $convertKeysToUppercase,
            $doHtmlDecode
        );

        // Compare signatures (must match exactly for valid IPN)
        if ($receivedSignature !== $expectedSignature) {
            throw new FormatException(
                "Signature is invalid. Expected: {$expectedSignature}, Received: {$receivedSignature}"
            );
        }
    }
}
