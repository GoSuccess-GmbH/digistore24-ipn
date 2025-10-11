<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Helper;

use GoSuccess\Digistore24IPN\Exception\FormatException;

/**
 * Helper class for generating and validating signatures.
 *
 * This class provides methods to calculate the expected signature based on
 * a passphrase and parameters, and to validate a received signature against
 * the expected one.
 */
final class SignatureHelper
{
    /**
     * Generates the expected signature for the given parameters.
     *
     * @param string $shaPassphrase The passphrase used for generating the signature.
     * @param array $parameters The parameters to include in the signature.
     * @param bool $convertKeysToUppercase Whether to convert parameter keys to uppercase.
     * @param bool $doHtmlDecode Whether to HTML decode parameter values.
     * @return string The expected signature.
     */
    public static function getExpectedSignature(
        string $shaPassphrase,
        array $parameters,
        bool $convertKeysToUppercase = false,
        bool $doHtmlDecode = false
    ): string {
        $algorithm = 'sha512';

        if (!$shaPassphrase) {
            throw new FormatException('No signature passphrase provided');
        }

        if (empty($parameters)) {
            throw new FormatException('No parameters provided for signature calculation');
        }

        unset($parameters['sha_sign'], $parameters['SHASIGN']);

        $keys = array_keys($parameters);

        $keysToSort = array_map(
            $convertKeysToUppercase ? 'strtoupper' : fn($k) => $k,
            $keys
        );

        array_multisort(
            $keysToSort,
            SORT_STRING,
            $keys
        );

        $shaString = '';
        foreach ($keys as $key) {
            $value = $parameters[$key];

            if ($doHtmlDecode && is_string($value)) {
                $value = html_entity_decode($value);
            }

            if ($value === null || $value === '' || $value === false) {
                continue;
            }

            $outKey = $convertKeysToUppercase ? strtoupper($key) : $key;
            $shaString .= "{$outKey}={$value}{$shaPassphrase}";
        }

        return strtoupper(hash($algorithm, $shaString));
    }

    /**
     * Validates the received signature against the expected signature.
     *
     * @param string $shaPassphrase The passphrase used for generating the signature.
     * @param array $data The data containing the received signature.
     * @param bool $convertKeysToUppercase Whether to convert parameter keys to uppercase.
     * @param bool $doHtmlDecode Whether to HTML decode parameter values.
     * @throws FormatException if the signature is invalid or not received.
     */
    public static function validateSignature(
        string $shaPassphrase,
        array $data,
        bool $convertKeysToUppercase = false,
        bool $doHtmlDecode = false
    ): void {
        $receivedSignature = $data['sha_sign']
            ?? $data['SHASIGN']
            ?? null;

        if ($receivedSignature === null) {
            throw new FormatException('No signature received.');
        }

        $expectedSignature = self::getExpectedSignature(
            $shaPassphrase,
            $data,
            $convertKeysToUppercase,
            $doHtmlDecode
        );

        if ($receivedSignature !== $expectedSignature) {
            throw new FormatException(
                "Signature is invalid. Expected: {$expectedSignature}, Received: {$receivedSignature}"
            );
        }
    }
}
