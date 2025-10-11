# Examples

This directory contains practical examples for using the Digistore24 IPN PHP Library with **PHP 8.4 Property Hooks**.

## 📁 Available Examples

### 1. `quickstart.php`
The simplest possible IPN handler. Great for getting started quickly.

**Features:**
- Basic signature validation
- Simple event handling
- Direct property access
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
Demonstrates direct property access and automatic type conversions.

**Features:**
- Direct property access: `$ipn->order_id`, `$ipn->product_id`
- Automatic array conversion for tags: `$ipn->tags` returns array
- Type conversions: integers, floats, booleans, dates, enums
- Working with comma-separated values

**Use this when:** You need to understand how Property Hooks work.

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

## � PHP 8.4 Property Hooks

This library uses PHP 8.4's Property Hooks feature for automatic type conversion and validation.

### Direct Property Access
```php
// v2.x - Direct property access (PHP 8.4)
$orderId = $ipn->order_id;
$amount = $ipn->amount_brutto;
$email = $ipn->email;

// ❌ NO LONGER: $ipn->getOrderId(), $ipn->getAmountBrutto()
```

### Automatic Type Conversions
```php
$ipn->amount_brutto;      // Automatically converted to float
$ipn->buyer_id;           // Automatically converted to int
$ipn->order_is_paid;      // Automatically converted to bool
$ipn->order_date;         // Automatically converted to DateTimeImmutable
$ipn->event;              // Automatically converted to Event enum
```

### Tags as Array
```php
// Tags are automatically split from comma-separated string to array
$ipn->tags;               // ['premium', 'vip', 'annual']
$ipn->tags[0];            // 'premium'
$ipn->tags[1];            // 'vip'

// ❌ NO LONGER: $ipn->tag1, $ipn->tag2, $ipn->tag3, etc.
```

---

## �🔒 Security Notes

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
if ($ipn->event === Event::CONNECTION_TEST) {
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
// product_ids contains comma-separated list
if ($ipn->product_ids) {
    $productIdsArray = array_map('intval', explode(',', $ipn->product_ids));
    foreach ($productIdsArray as $productId) {
        grantAccessToProduct($productId);
    }
}
```

### Handling Subscriptions
```php
switch ($ipn->event) {
    case Event::ON_PAYMENT:
        // First payment or rebill
        if ($ipn->pay_sequence_no === 1) {
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
    'email' => $ipn->email,
    'first_name' => $ipn->address_first_name,
    'last_name' => $ipn->address_last_name,
    'country' => $ipn->address_country,
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
