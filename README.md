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

use GoSuccess\Digistore24IPN\Notification;
use GoSuccess\Digistore24IPN\Response;
use GoSuccess\Digistore24IPN\Enum\Event;
use GoSuccess\Digistore24IPN\Security\Signature;
use GoSuccess\Digistore24IPN\Exception\FormatException;

require_once __DIR__ . '/vendor/autoload.php';

$shaPassphrase = 'your-secret-passphrase';

try {
    // Validate the signature first
    Signature::validateSignature($shaPassphrase, $_POST);
    
    // Create notification object from IPN data
    $notification = Notification::fromPost();

    // Access fields directly (no getter methods!)
    $event = $notification->event;
    $orderId = $notification->order_id;
    $amount = $notification->amount_brutto;
    $email = $notification->email;
    
    // Tags are automatically converted to array
    $tags = $notification->tags; // ['tag1', 'tag2', 'tag3']
    $firstTag = $notification->tags[0] ?? null;

    // Process the event
    switch ($event) {
        case Event::ON_PAYMENT:
            // Handle payment event
            
            // Create response
            $response = new Response();
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
$notification->order_id          // instead of getOrderId()
$notification->amount_brutto     // instead of getAmountBrutto()
$notification->email             // instead of getEmail()
$notification->product_name      // instead of getProductName()

// Automatic type conversion
$notification->amount_brutto     // float
$notification->buyer_id          // int
$notification->order_is_paid     // bool
$notification->order_date        // DateTimeImmutable
$notification->event             // Event enum
$notification->billing_status    // BillingStatus enum

// Tags are converted to array
$notification->tags              // ['webinar', 'premium', 'vip']
$notification->tags[0]           // 'webinar'
$notification->tags[1]           // 'premium'
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
   $orderId = $notification->order_id;
   $amount = $notification->amount_brutto;
   ```

2. **snake_case property names** (matching DS24 API exactly):
   ```php
   // Property names match Digistore24 IPN field names
   $notification->order_id           // not $ipn->orderId
   $notification->amount_brutto      // not $ipn->amountBrutto
   $notification->email              // buyer's email address
   $notification->address_first_name // billing address first name
   ```

3. **Tags as array** - No more `tag1` through `tag100`:
   ```php
   // OLD (v1.x)
   $tag1 = $ipn->getTag1();
   $tag2 = $ipn->getTag2();
   
   // NEW (v2.x)
   $tags = $notification->tags;     // ['tag1', 'tag2', 'tag3']
   $firstTag = $notification->tags[0];
   $secondTag = $notification->tags[1];
   ```

4. **Response DTO** - Direct property assignment:
   ```php
   // OLD (v1.x)
   $response->setHeadline('Welcome');
   
   // NEW (v2.x)
   $response->headline = 'Welcome';
   ```

See [UPGRADE.md](docs/UPGRADE.md) for detailed migration instructions.

## Development

### Development Commands

```bash
# Run tests
composer test

# Fix code style
composer cs:fix

# Static analysis
composer analyze

# Run all checks
composer test && composer cs:fix && composer analyze
```

### Project Status

**Version**: 2.0.0  
**PHP**: >= 8.4  
**Tests**: 69/69 passing ✅  
**PHPStan**: Level 8 ✅  
**Code Style**: PSR-12 ✅

## Documentation

- **[UPGRADE.md](docs/UPGRADE.md)** - Upgrade guide from v1.x to v2.0
- **[CHANGELOG.md](CHANGELOG.md)** - Version history and all changes
- **[CONTRIBUTING.md](CONTRIBUTING.md)** - Contribution guidelines
- **[examples/](examples/)** - Practical code examples

## Questions?

- **GitHub Issues**: https://github.com/GoSuccess-GmbH/digistore24-ipn/issues
- **Discussions**: https://github.com/GoSuccess-GmbH/digistore24-ipn/discussions

## Error Handling

All signature and format errors throw `GoSuccess\Digistore24IPN\Exception\FormatException`.

## License

MIT License - see [LICENSE](LICENSE)
