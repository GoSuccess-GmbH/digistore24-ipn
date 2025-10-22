<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN;

use GoSuccess\Digistore24IPN\Exception\FormatException;

/**
 * Response builder for Digistore24 IPN callbacks.
 *
 * This class constructs the response that your webhook endpoint sends back to Digistore24.
 * It uses PHP 8.4 Property Hooks for automatic validation and clean syntax.
 * 
 * The response format follows Digistore24's IPN specification:
 * - Must start with "OK" line
 * - Optional thankyou_url to redirect the customer
 * - Optional login credentials (username, password, loginurl)
 * - Optional headline text
 * - Optional custom data fields
 * 
 * @link https://dev.digistore24.com/hc/en-us/articles/32480217565969-Quick-Integration-Guide
 * 
 * Example:
 * ```php
 * $response = new Response();
 * $response->thankyouUrl = 'https://example.com/thank-you';
 * $response->headline = 'Welcome!';
 * $response->addLoginBlock('user123', 'pass456', 'https://example.com/login');
 * echo $response->toString(); // Sends response to Digistore24
 * ```
 */
class Response
{
    /**
     * Thank you URL to redirect the customer after successful payment.
     * 
     * When set, Digistore24 will redirect the customer to this URL after payment completion.
     * Property Hook validates that the value is a valid URL format.
     * 
     * @throws FormatException if the URL format is invalid
     */
    public ?string $thankyouUrl = null {
        set(string|null $value) {
            if ($value !== null && !filter_var($value, FILTER_VALIDATE_URL)) {
                throw new FormatException("Invalid URL format: $value");
            }
            $this->thankyouUrl = $value;
        }
    }

    /**
     * Headline text to display on the Digistore24 thank you page.
     * 
     * This text will be shown to the customer as a headline message
     * after the payment is completed.
     */
    public ?string $headline = null;

    /**
     * Array of login credential blocks.
     * 
     * Each block contains username, password, and loginurl for member areas.
     * Multiple login blocks are supported (e.g., for different access levels).
     * Use addLoginBlock() method to add login credentials.
     * 
     * @var array<int, array{username: string, password: string, loginurl: string}>
     */
    private array $loginBlocks = [];

    /**
     * Additional custom data fields to send back to Digistore24.
     * 
     * You can use this to pass custom data that will be available in the
     * Digistore24 order details. Keys cannot conflict with reserved field names
     * (thankyou_url, headline, username, password, loginurl).
     * 
     * @var array<string, string>
     */
    private array $additionalData = [];

    /**
     * Add a login credential block for member area access.
     * 
     * This method adds login credentials that will be sent to the customer
     * after successful payment. You can call this multiple times to add
     * multiple login blocks (e.g., for different membership levels).
     * 
     * The first block uses keys without suffix: username, password, loginurl
     * Additional blocks get numbered: username_2, password_2, loginurl_2, etc.
     *
     * @param string $username The username for the member area
     * @param string $password The password for the member area
     * @param string $loginurl The login URL for the member area
     * 
     * @example
     * ```php
     * // Single login block
     * $response->addLoginBlock('user123', 'pass456', 'https://example.com/login');
     * 
     * // Multiple login blocks
     * $response->addLoginBlock('basic_user', 'pass123', 'https://example.com/basic');
     * $response->addLoginBlock('premium_user', 'pass456', 'https://example.com/premium');
     * ```
     */
    public function addLoginBlock(string $username, string $password, string $loginurl): void
    {
        $this->loginBlocks[] = [
            'username' => $username,
            'password' => $password,
            'loginurl' => $loginurl,
        ];
    }

    /**
     * Set custom additional data field.
     * 
     * This method allows you to add custom key-value pairs to the response
     * that will be available in Digistore24 order details.
     * 
     * IMPORTANT: The following keys are reserved and will throw an exception:
     * - thankyou_url (use $response->thankyouUrl property instead)
     * - headline (use $response->headline property instead)
     * - username, password, loginurl (use addLoginBlock() method instead)
     * - Any keys with numbered suffixes like username_2, password_3, etc.
     *
     * @param string $key The custom field name
     * @param string $value The custom field value
     * @throws FormatException if the key is reserved
     * 
     * @example
     * ```php
     * $response->setAdditionalData('customer_level', 'premium');
     * $response->setAdditionalData('trial_ends', '2025-12-31');
     * ```
     */
    public function setAdditionalData(string $key, string $value): void
    {
        // Reserved keys that must use dedicated methods/properties
        $reservedKeys = [
            'thankyou_url',
            'headline',
            'username',
            'password',
            'loginurl'
        ];

        // Check if key matches reserved pattern (e.g., username_2, password_3)
        foreach ($reservedKeys as $reserved) {
            if ($key === $reserved || preg_match('/^' . preg_quote($reserved, '/') . '_\d+$/', $key)) {
                throw new FormatException("Key '$key' is reserved and cannot be set via additionalData. Please use direct property assignment for thankyouUrl/headline or addLoginBlock method.");
            }
        }

        $this->additionalData[$key] = $value;
    }

    /**
     * Convert the response to Digistore24 IPN format string.
     * 
     * Builds the response string according to Digistore24's IPN specification.
     * The format is line-based with key-value pairs separated by colons.
     * 
     * Response structure:
     * 1. Always starts with "OK"
     * 2. thankyou_url (if set)
     * 3. Login blocks (username, password, loginurl) with numbering for multiple blocks
     * 4. headline (if set)
     * 5. Additional custom data fields
     * 
     * This string should be echoed/returned from your IPN endpoint.
     *
     * @return string The formatted response string ready to send to Digistore24
     * @throws FormatException if any login block is missing required fields
     * 
     * @example
     * Output format:
     * ```
     * OK
     * thankyou_url: https://example.com/thanks
     * username: user123
     * password: pass456
     * loginurl: https://example.com/login
     * headline: Welcome to our service!
     * custom_field: custom_value
     * ```
     */
    public function toString(): string
    {
        // Every response must start with "OK"
        $lines = ['OK'];

        // Add thankyou URL if provided
        if ($this->thankyouUrl !== null) {
            $lines[] = (string) 'thankyou_url: ' . $this->thankyouUrl;
        }

        // Add all login blocks with proper numbering
        foreach ($this->loginBlocks as $i => $block) {
            // Validate that all required fields are present and non-empty
            if (
                $block['username'] === '' ||
                $block['password'] === '' ||
                $block['loginurl'] === ''
            ) {
                throw new FormatException("All of username, password, and loginurl must be set in each login block.");
            }

            // First block has no suffix, additional blocks get _2, _3, etc.
            $index = $i === 0 ? '' : '_' . ($i + 1);
            $lines[] = "username$index: " . $block['username'];
            $lines[] = "password$index: " . $block['password'];
            $lines[] = "loginurl$index: " . $block['loginurl'];
        }

        // Add headline if provided
        if ($this->headline !== null) {
            $lines[] = (string) 'headline: ' . $this->headline;
        }

        // Add all custom additional data fields
        foreach ($this->additionalData as $key => $value) {
            $lines[] = (string) $key . ': ' . $value;
        }

        // Join all lines with newline character
        return implode("\n", $lines);
    }
}
