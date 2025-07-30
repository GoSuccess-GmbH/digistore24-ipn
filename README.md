# Digistore24 IPN PHP Library

A PHP library for handling Digistore24 Instant Payment Notification (IPN) webhooks. This package provides DTOs for all possible webhook fields, signature validation, and helper utilities to make integration with Digistore24's IPN system easy and secure.

## Features
- Typed DTOs for all Digistore24 IPN fields
- Signature generation and validation
- Enum support for event types and other constants
- Exception handling for invalid IPN data

## Installation

Install via Composer:

```bash
composer require gosuccess/digistore24-ipn
```

## Usage


### Receiving and Validating an IPN

```php
<?php

use GoSuccess\Digistore24IPN\Dto\IPNRequestDto;
use GoSuccess\Digistore24IPN\Dto\IPNResponseDto;
use GoSuccess\Digistore24IPN\Enum\Event;
use GoSuccess\Digistore24IPN\Helper\SignatureHelper;
use GoSuccess\Digistore24IPN\Exception\IPNResponseFormatException;

$shaPassphrase = 'your-secret-passphrase';
$ipnData = $_POST ?: $_GET;

try {
    // Validate the signature
    SignatureHelper::validateSignature($shaPassphrase, $ipnData);

    // Map IPN data to DTO
    $ipnRequest = IPNRequestDto::map();

    // Access fields
    $event = $ipnRequest->getEvent();
    $orderId = $ipnRequest->getOrderId();
    $amount = $ipnRequest->getAmountBrutto();

    // Process the event
    switch ($event) {
        case Event::ON_PAYMENT:
            // Handle payment event ...

            // Example response, not mandatory
            // You can customize the response as needed
            $response = new IPNResponseDto();
            $response->setHeadline('Login Details');
            $response->addLoginBlock(
                'username',
                'password',
                'https://example.com/login'
            );
            $response->addLoginBlock(
                'another_username',
                'another_password',
                'https://example.com/another-login'
            );
            $response->setAdditionalData('key1', 'value1');
            $response->setAdditionalData('License Key', '123-456-789');
            die($response->toString());
            break;
        case Event::ON_PAYMENT_MISSED:
            // Handle missed payment event
            break;
        case Event::LAST_PAID_DAY:
            // Handle last paid day event
            break;
        ... // Handle other events as needed
        default:
            throw new IPNResponseFormatException('Unknown event type!');
    }
    // Your business logic here
    // ...
} catch (IPNResponseFormatException $e) {
    // Handle invalid signature or data
    http_response_code(400);
    error_log('IPN Error: ' . $e->getMessage());
    echo 'ERROR: ' . htmlspecialchars($e->getMessage());
    exit;
}
```

## Error Handling

All signature and format errors throw `GoSuccess\Digistore24IPN\Exception\IPNResponseFormatException`.

## License

MIT License
