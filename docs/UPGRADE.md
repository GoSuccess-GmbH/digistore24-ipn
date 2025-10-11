# Upgrade Guide

## Upgrading from 1.x to 2.0.0

### ⚠️ BREAKING CHANGES - Major Version Update

Version 2.0 introduces **PHP 8.4 Property Hooks**, which fundamentally changes how you interact with the library. This is a **breaking change** that requires code modifications.

### System Requirements

- **PHP 8.4 or higher** (up from 8.0+)
- Composer 2.0+

### Breaking Change #1: No Getter Methods

**Before (v1.x):**
```php
$orderId = $ipn->getOrderId();
$amount = $ipn->getAmountBrutto();
$email = $ipn->getEmail();
$event = $ipn->getEvent();
```

**After (v2.0):**
```php
$orderId = $ipn->order_id;
$amount = $ipn->amount_brutto;
$email = $ipn->email;
$event = $ipn->event;
```

**Why?** PHP 8.4 Property Hooks eliminate the need for getter methods. Properties are now directly accessible with automatic type conversion and validation.

### Breaking Change #2: Snake_case Property Names

All properties now use **snake_case** names matching the Digistore24 IPN API exactly.

**Before (v1.x):**
```php
$ipn->getAmountBrutto();      // camelCase method
$ipn->getAddressFirstName();  // camelCase method
$ipn->getOrderId();           // camelCase method
```

**After (v2.0):**
```php
$ipn->amount_brutto;          // snake_case property
$ipn->address_first_name;     // snake_case property
$ipn->order_id;               // snake_case property
```

**Why?** This matches the exact field names from Digistore24, making debugging and API documentation comparison easier.

### Breaking Change #3: No Setter Methods

**Before (v1.x):**
```php
$response = new IPNResponseDto();
$response->setHeadline('Welcome!');
$response->setForwardToUrl('https://example.com');
```

**After (v2.0):**
```php
$response = new IPNResponseDto();
$response->headline = 'Welcome!';
$response->forward_to_url = 'https://example.com';
```

**Note:** Helper methods like `addLoginBlock()` and `setAdditionalData()` still exist.

### Breaking Change #4: Tags as Array

**Before (v1.x):**
```php
$tag1 = $ipn->getTag1();
$tag2 = $ipn->getTag2();
$tag3 = $ipn->getTag3();
// ... up to getTag100()
```

**After (v2.0):**
```php
$tags = $ipn->tags;           // ['tag1', 'tag2', 'tag3']
$firstTag = $ipn->tags[0];    // 'tag1'
$secondTag = $ipn->tags[1];   // 'tag2'

// OR check if specific tag exists
if (in_array('premium', $ipn->tags ?? [])) {
    // Handle premium tag
}
```

**Why?** Much cleaner API. Tags are automatically split from the comma-separated string into an array.

### Breaking Change #5: Static Factory Methods Changed

**Before (v1.x):**
```php
$ipn = IPNRequestDto::map();
```

**After (v2.0):**
```php
$ipn = IPNRequestDto::fromPost();  // For $_POST data
// OR
$ipn = IPNRequestDto::fromGet();   // For $_GET data
// OR
$ipn = IPNRequestDto::fromArray($data);  // For custom array
```

**Why?** More explicit about the data source.

### Breaking Change #6: No Array Helper Methods

The following helper methods **no longer exist**:

**Removed in v2.0:**
- `getAllProductIds()` - Use direct property access
- `getAllCouponCodes()` - Use direct property access
- `getAllTags()` - Use `$ipn->tags` array
- `getAllLicenseKeys()` - Use direct property access
- `getAllEticketUrls()` - Use direct property access
- `getAllUpgradedProductIds()` - Use direct property access
- `getAllCouponAmountsLeft()` - Use direct property access
- `getAllCouponAmountsTotal()` - Use direct property access

**Why?** With Property Hooks, direct property access is simpler and more performant.

### Migration Steps

#### Step 1: Update PHP Version

Ensure you're running **PHP 8.4+**:
```bash
php -v
```

#### Step 2: Update Composer Dependency

```bash
composer require gosuccess/digistore24-ipn:^2.0
```

#### Step 3: Update All Getter Calls

Use search & replace in your IDE:

| Search (v1.x) | Replace (v2.0) |
|--------------|---------------|
| `->getOrderId()` | `->order_id` |
| `->getAmountBrutto()` | `->amount_brutto` |
| `->getEmail()` | `->email` |
| `->getEvent()` | `->event` |
| `->getAddressFirstName()` | `->address_first_name` |
| `->getAddressLastName()` | `->address_last_name` |
| `->getAddressCountry()` | `->address_country` |
| `->getProductId()` | `->product_id` |
| `->getBuyerId()` | `->buyer_id` |

**Regex pattern for mass replacement:**
```regex
Find:    ->get([A-Z][a-zA-Z]+)\(\)
Replace: ->{{SNAKE_CASE($1)}}
```

Use your IDE's camelCase → snake_case conversion feature.

#### Step 4: Update Setter Calls

| Search (v1.x) | Replace (v2.0) |
|--------------|---------------|
| `->setHeadline('text')` | `->headline = 'text'` |
| `->setForwardToUrl($url)` | `->forward_to_url = $url` |

#### Step 5: Update Tag Access

**Before:**
```php
$tag1 = $ipn->getTag1();
$tag2 = $ipn->getTag2();
if ($tag1 === 'premium') {
    // ...
}
```

**After:**
```php
$tags = $ipn->tags ?? [];
if (in_array('premium', $tags)) {
    // ...
}
```

#### Step 6: Update Factory Method Calls

**Before:**
```php
$ipn = IPNRequestDto::map();
```

**After:**
```php
$ipn = IPNRequestDto::fromPost();
```

#### Step 7: Test Your Integration

1. ✅ Test signature validation
2. ✅ Test all event handlers
3. ✅ Test response generation
4. ✅ Test logging
5. ✅ Use Digistore24's "Test Connection" feature

### What You Gain

#### 1. Better Performance
- No reflection overhead
- Direct property access
- Property Hooks are compiled

#### 2. Cleaner Code
```php
// v1.x - Verbose
$orderId = $ipn->getOrderId();
$amount = $ipn->getAmountBrutto();
$email = $ipn->getEmail();

// v2.0 - Clean
$orderId = $ipn->order_id;
$amount = $ipn->amount_brutto;
$email = $ipn->email;
```

#### 3. Automatic Type Conversion
```php
$ipn->amount_brutto;      // Automatically float
$ipn->buyer_id;           // Automatically int
$ipn->order_is_paid;      // Automatically bool
$ipn->order_date;         // Automatically DateTimeImmutable
$ipn->event;              // Automatically Event enum
$ipn->tags;               // Automatically array
```

#### 4. IDE Support
Modern IDEs understand Property Hooks and provide better autocomplete and type hints.

#### 5. Matches Digistore24 API Exactly
Property names are now **identical** to Digistore24's IPN field names, making documentation easier to follow.

### Complete Migration Example

**Before (v1.x):**
```php
<?php
use GoSuccess\Digistore24IPN\Dto\IPNRequestDto;
use GoSuccess\Digistore24IPN\Dto\IPNResponseDto;
use GoSuccess\Digistore24IPN\Enum\Event;
use GoSuccess\Digistore24IPN\Helper\SignatureHelper;

$secret = 'your-secret';

SignatureHelper::validateSignature($secret, $_POST);
$ipn = IPNRequestDto::map();

if ($ipn->getEvent() === Event::ON_PAYMENT) {
    $orderId = $ipn->getOrderId();
    $email = $ipn->getEmail();
    $amount = $ipn->getAmountBrutto();
    
    // Get tags
    $tag1 = $ipn->getTag1();
    $tag2 = $ipn->getTag2();
    
    // Create response
    $response = new IPNResponseDto();
    $response->setHeadline('Welcome!');
    die($response->toString());
}
```

**After (v2.0):**
```php
<?php
use GoSuccess\Digistore24IPN\Dto\IPNRequestDto;
use GoSuccess\Digistore24IPN\Dto\IPNResponseDto;
use GoSuccess\Digistore24IPN\Enum\Event;
use GoSuccess\Digistore24IPN\Helper\SignatureHelper;

$secret = 'your-secret';

SignatureHelper::validateSignature($secret, $_POST);
$ipn = IPNRequestDto::fromPost();

if ($ipn->event === Event::ON_PAYMENT) {
    $orderId = $ipn->order_id;
    $email = $ipn->email;
    $amount = $ipn->amount_brutto;
    
    // Get tags (now array!)
    $tags = $ipn->tags ?? [];
    
    // Create response
    $response = new IPNResponseDto();
    $response->headline = 'Welcome!';
    die($response->toString());
}
```

### Need Help?

- 📖 Check the [examples](../examples/) directory for complete working examples
- 📝 Review the [CHANGELOG.md](../CHANGELOG.md) for detailed changes
- 🐛 Open an issue on GitHub if you encounter problems

### Rollback

If you need to rollback to v1.x:

```bash
composer require gosuccess/digistore24-ipn:^1.0
```

**Note:** v1.x will receive security updates but no new features.
