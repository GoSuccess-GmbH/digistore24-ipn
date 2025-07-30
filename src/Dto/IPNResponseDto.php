<?php

declare(strict_types=1);

namespace GoSuccess\Digistore24IPN\Dto;

use GoSuccess\Digistore24IPN\Exception\IPNResponseFormatException;

/**
 * Class IPNResponseDto
 *
 * This class represents the response structure for an IPN (Instant Payment Notification) response.
 * It allows setting a thank you URL, headline, login blocks, and additional data.
 */
class IPNResponseDto
{
    public function __construct(
        private ?string $thankyouUrl = null,
        private ?string $headline = null,
        private array $loginBlocks = [],
        private array $additionalData = []
    ) {}

    /**
     * Set the thank you URL.
     *
     * @param string $url
     */
    public function setThankyouUrl(string $url): void
    {
        $this->thankyouUrl = $url;
    }

    /**
     * Set the headline.
     *
     * @param string $headline
     */
    public function setHeadline(string $headline): void
    {
        $this->headline = $headline;
    }

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
                throw new IPNResponseFormatException("Key '$key' is reserved and cannot be set via additionalData. Please use setThankyouUrl, setHeadline, or addLoginBlock methods.");
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
