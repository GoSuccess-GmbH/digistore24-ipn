# Upgrade Guide

## Upgrading from 1.0.x to 2.0.0

### Breaking Changes

**None!** All changes are backward compatible. Your existing code will continue to work without modifications.

### New Features

#### 1. Magic Methods for Dynamic Getters

You can now use dynamic getters for numbered fields. The existing explicit getters still work:

```php
// Old way (still works)
$code2 = $ipn->getCouponCode2();

// New way (also works)
$code2 = $ipn->{'getCouponCode2'}();

// Loop through numbered fields easily
for ($i = 1; $i <= 10; $i++) {
    $method = $i === 1 ? 'getCouponCode' : "getCouponCode$i";
    $code = $ipn->$method();
}
```

#### 2. Array Helper Methods

New convenient methods for getting grouped data:

```php
// Get all coupon codes as array
$codes = $ipn->getAllCouponCodes();
// Returns: [1 => 'CODE1', 2 => 'CODE2', ...]

// Get all product IDs
$products = $ipn->getAllProductIds();

// Get all tags
$tags = $ipn->getAllTags();

// Get all license keys
$licenses = $ipn->getAllLicenseKeys();

// Get all e-ticket URLs
$tickets = $ipn->getAllEticketUrls();

// Get all upgraded product IDs
$upgraded = $ipn->getAllUpgradedProductIds();

// Get remaining coupon amounts
$amountsLeft = $ipn->getAllCouponAmountsLeft();

// Get total coupon amounts
$amountsTotal = $ipn->getAllCouponAmountsTotal();
```

#### 3. Enhanced URL Validation

URLs in response DTOs are now validated:

```php
$response = new IPNResponseDto();

// Valid URLs work fine
$response->setThankyouUrl('https://example.com/thanks');

// Invalid URLs throw exception
try {
    $response->setThankyouUrl('not-a-url');
} catch (IPNResponseFormatException $e) {
    // Handle invalid URL
}
```

#### 4. Improved DateTime Parsing

Better handling of various date formats:

```php
// Supports multiple formats:
// - ISO 8601: 2025-10-11T14:30:00+00:00
// - MySQL: 2025-10-11 14:30:00
// - Date only: 2025-10-11
// - German: 11.10.2025 14:30:00
// And more...

// Invalid dates return null instead of throwing
$date = $ipn->getOrderDateTime(); // null if invalid
```

#### 5. Enhanced Security

Timing-attack protection in signature validation:

```php
// Internally uses hash_equals() instead of ===
SignatureHelper::validateSignature($secret, $data);
```

### Migration Steps

**No migration needed!** Just update your dependency:

```bash
composer update gosuccess/digistore24-ipn
```

### Recommended Changes (Optional)

While not required, consider using the new array helpers for cleaner code:

**Before:**
```php
$products = [];
if ($ipn->getProductId()) $products[] = $ipn->getProductId();
if ($ipn->getProductId2()) $products[] = $ipn->getProductId2();
if ($ipn->getProductId3()) $products[] = $ipn->getProductId3();
// ... repeat for all 100 products
```

**After:**
```php
$products = $ipn->getAllProductIds();
```

### Testing Your Integration

After updating, test your IPN handler:

1. Use Digistore24's "Test Connection" feature
2. Process a test transaction
3. Verify logging still works
4. Check all event handlers

### Need Help?

- Check the [examples](examples/) directory
- Review the [CHANGELOG.md](CHANGELOG.md)
- Open an issue on GitHub

### Rollback

If you need to rollback:

```bash
composer require gosuccess/digistore24-ipn:^1.0
```
