# Digistore24 IPN PHP Library

A modern PHP 8.4+ library for handling Digistore24 Instant Payment Notification (IPN) webhooks. This package provides typed DTOs with Property Hooks for all possible webhook fields, signature validation, and helper utilities to make integration with Digistore24's IPN system easy and secure.

## Features
- 🚀 **PHP 8.4 Property Hooks** - Automatic type conversion and validation
- 📦 **Typed DTOs** for all Digistore24 IPN fields with snake_case names matching DS24 API exactly
- 🔐 **Signature validation** for secure webhook processing
- 🎯 **Enum support** for event types and other constants
- ⚡ **Zero reflection** - Direct property access for maximum performance
- 🛡️ **Exception handling** for invalid IPN data

## Requirements

- PHP 8.4 or higher
- Composer

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
use GoSuccess\Digistore24IPN\Exception\FormatException;

require_once __DIR__ . '/vendor/autoload.php';

$shaPassphrase = 'your-secret-passphrase';

try {
    // Validate the signature first
    SignatureHelper::validateSignature($shaPassphrase, $_POST);
    
    // Create DTO from IPN data after validation
    $ipn = IPNRequestDto::fromPost();

    // Access fields directly (no getter methods!)
    $event = $ipn->event;
    $orderId = $ipn->order_id;
    $amount = $ipn->amount_brutto;
    $email = $ipn->email;
    
    // Tags are automatically converted to array
    $tags = $ipn->tags; // ['tag1', 'tag2', 'tag3']
    $firstTag = $ipn->tags[0] ?? null;

    // Process the event
    switch ($event) {
        case Event::ON_PAYMENT:
            // Handle payment event
            
            // Create response
            $response = new IPNResponseDto();
            $response->headline = 'Login Details';
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
            
        default:
            throw new FormatException('Unknown event type!');
    }
    
} catch (FormatException $e) {
    // Handle invalid signature or data
    http_response_code(400);
    error_log('IPN Error: ' . $e->getMessage());
    echo 'ERROR: ' . htmlspecialchars($e->getMessage());
    exit;
}
```

### Property Access

All properties use **snake_case** names matching the Digistore24 IPN API exactly:

```php
// Direct property access (PHP 8.4 Property Hooks)
$ipn->order_id          // instead of getOrderId()
$ipn->amount_brutto     // instead of getAmountBrutto()
$ipn->email             // instead of getEmail()
$ipn->product_name      // instead of getProductName()

// Automatic type conversion
$ipn->amount_brutto     // float
$ipn->buyer_id          // int
$ipn->order_is_paid     // bool
$ipn->order_date        // DateTimeImmutable
$ipn->event             // Event enum
$ipn->billing_status    // BillingStatus enum

// Tags are converted to array
$ipn->tags              // ['webinar', 'premium', 'vip']
$ipn->tags[0]           // 'webinar'
$ipn->tags[1]           // 'premium'
```

## Migration from v1.x

**Version 2.0** introduces breaking changes with PHP 8.4 Property Hooks:

### Breaking Changes

1. **No getter methods** - Use direct property access:
   ```php
   // OLD (v1.x)
   $orderId = $ipn->getOrderId();
   $amount = $ipn->getAmountBrutto();
   
   // NEW (v2.x)
   $orderId = $ipn->order_id;
   $amount = $ipn->amount_brutto;
   ```

2. **snake_case property names** (matching DS24 API exactly):
   ```php
   // Property names match Digistore24 IPN field names
   $ipn->order_id           // not $ipn->orderId
   $ipn->amount_brutto      // not $ipn->amountBrutto
   $ipn->email              // buyer's email address
   $ipn->address_first_name // billing address first name
   ```

3. **Tags as array** - No more `tag1` through `tag100`:
   ```php
   // OLD (v1.x)
   $tag1 = $ipn->getTag1();
   $tag2 = $ipn->getTag2();
   
   // NEW (v2.x)
   $tags = $ipn->tags;     // ['tag1', 'tag2', 'tag3']
   $firstTag = $ipn->tags[0];
   $secondTag = $ipn->tags[1];
   ```

4. **Response DTO** - Direct property assignment:
   ```php
   // OLD (v1.x)
   $response->setHeadline('Welcome');
   
   // NEW (v2.x)
   $response->headline = 'Welcome';
   ```

See [UPGRADE.md](docs/UPGRADE.md) for detailed migration instructions.

## Error Handling

All signature and format errors throw `GoSuccess\Digistore24IPN\Exception\FormatException`.

## License

MIT License
