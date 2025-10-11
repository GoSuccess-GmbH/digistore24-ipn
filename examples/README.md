# Examples

This directory contains practical examples for using the Digistore24 IPN PHP Library.

## 📁 Available Examples

### 1. `quickstart.php`
The simplest possible IPN handler. Great for getting started quickly.

**Features:**
- Basic signature validation
- Simple event handling
- Login credentials response

**Use this when:** You need a quick, minimal implementation.

---

### 2. `ipn-handler.php`
Complete, production-ready IPN handler with full event handling.

**Features:**
- Handles all IPN events
- Error logging
- Comprehensive business logic hooks
- Response generation
- Best practices implementation

**Handles:**
- ✅ ON_PAYMENT
- ✅ ON_REFUND
- ✅ ON_CHARGEBACK
- ✅ ON_PAYMENT_MISSED
- ✅ ON_REBILL_CANCELLED
- ✅ ON_REBILL_RESUMED
- ✅ LAST_PAID_DAY
- ✅ CONNECTION_TEST

**Use this when:** You need a complete, production-ready solution.

---

### 3. `array-helpers.php`
Demonstrates the convenient array helper methods.

**Features:**
- `getAllProductIds()` - Get all products as array
- `getAllCouponCodes()` - Get all coupons as array
- `getAllTags()` - Get all tags as array
- `getAllLicenseKeys()` - Get all licenses as array
- `getAllEticketUrls()` - Get all e-tickets as array
- And more...

**Use this when:** You need to work with multiple products, coupons, or other grouped data.

---

## 🚀 Quick Start

1. Install the library:
```bash
composer require gosuccess/digistore24-ipn
```

2. Copy `quickstart.php` to your web server

3. Update the secret:
```php
$secret = 'YOUR_DIGISTORE24_SECRET';
```

4. Configure your IPN URL in Digistore24:
```
https://yoursite.com/ipn-handler.php
```

5. Test the connection using the "Test Connection" button in Digistore24

---

## 🔒 Security Notes

### Always validate signatures!
```php
SignatureHelper::validateSignature($secret, $_POST);
```

### Use environment variables for secrets
```php
$secret = getenv('DIGISTORE24_IPN_SECRET');
```

### Enable HTTPS
IPN endpoints should always use HTTPS to protect sensitive data.

---

## 📝 Logging

For production environments, implement proper logging:

```php
function logIpn(string $message, array $context = []): void
{
    $logFile = __DIR__ . '/logs/ipn.log';
    $timestamp = date('Y-m-d H:i:s');
    $contextStr = json_encode($context);
    $logMessage = "[$timestamp] $message $contextStr\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}
```

---

## 🧪 Testing

### Test Connection
Use Digistore24's "Test Connection" button to verify your endpoint:
```php
if ($ipn->getEvent() === Event::CONNECTION_TEST) {
    echo "OK";
    exit;
}
```

### Manual Testing
Send test IPNs with curl:
```bash
curl -X POST https://yoursite.com/ipn-handler.php \
  -d "order_id=TEST123" \
  -d "event=on_payment" \
  -d "sha_sign=VALID_SIGNATURE"
```

---

## 🎯 Event Flow

### Successful Payment Flow
1. **ON_PAYMENT** → Grant access, create account
2. User has full access
3. (Optional) **ON_REBILL_CANCELLED** → User cancelled subscription
4. **LAST_PAID_DAY** → Revoke access permanently

### Failed Payment Flow
1. **ON_PAYMENT_MISSED** → Temporarily suspend access
2. Digistore24 retries payment
3. If successful: **ON_PAYMENT** → Restore access
4. If all retries fail: **LAST_PAID_DAY** → Revoke access

### Refund Flow
1. **ON_REFUND** → Immediately revoke access
2. Cancel licenses, deactivate account

---

## 💡 Tips

### Working with Multiple Products
```php
$productIds = $ipn->getAllProductIds();
foreach ($productIds as $index => $productId) {
    grantAccessToProduct($productId);
}
```

### Handling Subscriptions
```php
switch ($ipn->getEvent()) {
    case Event::ON_PAYMENT:
        // First payment or rebill
        if ($ipn->getPaySequenceNo() === 1) {
            echo "First payment";
        } else {
            echo "Rebill payment";
        }
        break;
}
```

### Getting Customer Data
```php
$customer = [
    'email' => $ipn->getEmail(),
    'first_name' => $ipn->getAddressFirstName(),
    'last_name' => $ipn->getAddressLastName(),
    'country' => $ipn->getAddressCountry(),
];
```

---

## 📚 Further Reading

- [Digistore24 IPN Documentation](https://dev.digistore24.com/)
- [Main README](../README.md)
- [CHANGELOG](../CHANGELOG.md)
- [Contributing Guide](../CONTRIBUTING.md)

---

## ❓ Questions?

Open an issue on GitHub: https://github.com/GoSuccess-GmbH/digistore24-ipn/issues
