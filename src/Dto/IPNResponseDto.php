<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Dto;

use GoSuccess\Digistore24IPN\Exception\IPNResponseFormatException;

/**
 * Class IPNResponseDto
 *
 * This class represents the response structure for an IPN (Instant Payment Notification) response.
 * It uses PHP 8.4 Property Hooks for clean, direct property access with validation.
 */
class IPNResponseDto
{
    /**
     * Thank you URL to redirect the customer after payment.
     */
    public ?string $thankyouUrl = null {
        set {
            if ($value !== null && !filter_var($value, FILTER_VALIDATE_URL)) {
                throw new IPNResponseFormatException("Invalid URL format: $value");
            }
            $this->thankyouUrl = $value;
        }
    }

    /**
     * Headline text to display to the customer.
     */
    public ?string $headline = null;

    /**
     * Array of login blocks containing username, password, and loginurl.
     * @var array<int, array{username: string, password: string, loginurl: string}>
     */
    private array $loginBlocks = [];

    /**
     * Additional custom data fields.
     * @var array<string, string>
     */
    private array $additionalData = [];

    /**
     * Add a login block with username, password, and login URL.
     *
     * @param string $username
     * @param string $password
     * @param string $loginurl
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
     * Set additional data for the response.
     *
     * @param string $key
     * @param string $value
     * @throws IPNResponseFormatException if the key is reserved
     */
    public function setAdditionalData(string $key, string $value): void
    {
        $reservedKeys = [
            'thankyou_url',
            'headline',
            'username',
            'password',
            'loginurl'
        ];

        foreach ($reservedKeys as $reserved) {
            if ($key === $reserved || preg_match('/^' . preg_quote($reserved, '/') . '_\d+$/', $key)) {
                throw new IPNResponseFormatException("Key '$key' is reserved and cannot be set via additionalData. Please use direct property assignment for thankyouUrl/headline or addLoginBlock method.");
            }
        }

        $this->additionalData[$key] = $value;
    }

    /**
     * Convert the response data to a string format.
     *
     * @return string
     * @throws IPNResponseFormatException if any login block is missing required fields
     */
    public function toString(): string
    {
        $lines = ['OK'];

        if ($this->thankyouUrl !== null) {
            $lines[] = (string) 'thankyou_url: ' . $this->thankyouUrl;
        }

        foreach ($this->loginBlocks as $i => $block) {
            if (
                !isset($block['username'], $block['password'], $block['loginurl']) ||
                $block['username'] === '' ||
                $block['password'] === '' ||
                $block['loginurl'] === ''
            ) {
                throw new IPNResponseFormatException("All of username, password, and loginurl must be set in each login block.");
            }

            $index = $i === 0 ? '' : '_' . ($i + 1);
            $lines[] = "username$index: " . $block['username'];
            $lines[] = "password$index: " . $block['password'];
            $lines[] = "loginurl$index: " . $block['loginurl'];
        }

        if ($this->headline !== null) {
            $lines[] = (string) 'headline: ' . $this->headline;
        }

        foreach ($this->additionalData as $key => $value) {
            $lines[] = (string) $key . ': ' . $value;
        }

        return implode("\n", $lines);
    }
}
