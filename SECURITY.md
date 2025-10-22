# Security Policy

## Supported Versions

We provide security updates for the following versions:

| Version | Supported          | PHP Version |
| ------- | ------------------ | ----------- |
| 2.0.x   | :white_check_mark: | 8.4+        |
| 1.1.x   | :x:                | 8.0-8.3     |
| 1.0.x   | :x:                | 8.0-8.3     |

**Note:** Version 2.0.0 requires PHP 8.4+ due to Property Hooks. Only the latest major version receives security updates.

## Reporting a Vulnerability

We take security seriously. If you discover a security vulnerability, please follow these steps:

### 1. **Do NOT** open a public issue

Security vulnerabilities should not be publicly disclosed until they have been addressed.

### 2. Report via Email

Send details to: **security@gosuccess.io**

Include:
- Description of the vulnerability
- Steps to reproduce
- Potential impact
- Suggested fix (if available)

### 3. What to Expect

- **Acknowledgment:** Within 48 hours
- **Initial Assessment:** Within 5 business days
- **Fix & Disclosure:** Coordinated with you before public release

### 4. Responsible Disclosure

We follow responsible disclosure practices:
- We will work with you to understand and validate the issue
- We will develop and test a fix
- We will credit you in the security advisory (unless you prefer anonymity)
- We will release a patch and security advisory

## Security Best Practices

When using this library:

### 1. Always Validate Signatures

```php
use GoSuccess\Digistore24\Ipn\Security\Signature;
use GoSuccess\Digistore24\Ipn\Exception\FormatException;

try {
    // REQUIRED: Validate signature before processing
    Signature::validateSignature('your-secret-passphrase', $_POST);
    
    // Only process if signature is valid
    $notification = Notification::fromPost();
    
} catch (FormatException $e) {
    // Log and reject invalid requests
    error_log('IPN signature validation failed: ' . $e->getMessage());
    http_response_code(403);
    exit;
}
```

### 2. Use HTTPS Only

Configure your IPN endpoint to use HTTPS to prevent man-in-the-middle attacks.

### 3. Keep Your Passphrase Secret

- Never commit your IPN passphrase to version control
- Store in environment variables or secure configuration
- Rotate regularly (every 90 days recommended)

```php
// Good: Load from environment
$passphrase = $_ENV['DIGISTORE24_IPN_PASSPHRASE'];

// Bad: Hardcoded in source code
$passphrase = 'my-secret-123'; // DON'T DO THIS!
```

### 4. Rate Limiting

Implement rate limiting on your IPN endpoint to prevent abuse:

```php
// Example: Max 100 requests per minute per IP
if ($requestCount > 100) {
    http_response_code(429);
    exit('Too many requests');
}
```

### 5. Input Validation

While this library handles type conversion, always validate business logic:

```php
$notification = Notification::fromPost();

// Validate amounts are positive
if ($notification->amount_brutto <= 0) {
    throw new Exception('Invalid amount');
}

// Validate email format
if (!filter_var($notification->email, FILTER_VALIDATE_EMAIL)) {
    throw new Exception('Invalid email');
}
```

### 6. Keep Dependencies Updated

```bash
# Regular updates
composer update gosuccess/digistore24-ipn

# Check for security advisories
composer audit
```

## Known Security Considerations

### SHA-512 Signature Validation

This library uses SHA-512 for signature validation, which is cryptographically secure. However:

- Ensure your PHP installation has OpenSSL enabled
- Use sufficiently long and random passphrases (min. 32 characters)
- Never reuse passphrases across different services

### PHP 8.4 Requirement

Version 2.0.0 requires PHP 8.4+. Ensure your PHP installation receives security updates:

```bash
# Check PHP version
php -v

# Keep PHP updated
# Windows: Use official PHP builds from windows.php.net
# Linux: Use distribution package manager
# Docker: Use official php:8.4-* images
```

## Security Advisories

Security advisories will be published at:
- GitHub Security Advisories: https://github.com/GoSuccess-GmbH/digistore24-ipn/security/advisories
- Packagist: https://packagist.org/packages/gosuccess/digistore24-ipn

## Bug Bounty Program

We currently do not offer a bug bounty program, but we deeply appreciate responsible disclosure and will publicly acknowledge your contribution.

## Contact

- **Security Issues:** security@gosuccess.io
- **General Support:** https://github.com/GoSuccess-GmbH/digistore24-ipn/issues

---

**Thank you for helping keep Digistore24 IPN PHP Library secure!**
