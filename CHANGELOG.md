# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2025-10-22

### 🚨 BREAKING CHANGES

This is a **major version update** with breaking changes. Please read the [UPGRADE.md](docs/UPGRADE.md) guide before updating.

#### Changed
- **BREAKING**: Namespace changed from `GoSuccess\Digistore24IPN` to `GoSuccess\Digistore24\Ipn`
- **BREAKING**: Class `IPNRequestDto` renamed to `Notification`
- **BREAKING**: Class `IPNResponseDto` renamed to `Response`
- **BREAKING**: Minimum PHP version is now **8.4** (was 8.0+)
- **BREAKING**: All properties now use **snake_case** names matching Digistore24 IPN API exactly (e.g., `order_id`, `amount_brutto`, `address_first_name`)
- **BREAKING**: Replaced all getter methods with **direct property access** using PHP 8.4 Property Hooks
  - Old: `$ipn->getOrderId()`
  - New: `$notification->order_id`
- **BREAKING**: Replaced all setter methods with **direct property assignment**
  - Old: `$response->setHeadline('text')`
  - New: `$response->headline = 'text'`
- **BREAKING**: Changed static factory method from `IPNRequestDto::map()` to:
  - `Notification::fromPost()` - For $_POST data
  - `Notification::fromGet()` - For $_GET data
  - `Notification::fromArray($data)` - For custom array
- **BREAKING**: Removed `tag1` through `tag100` properties, replaced with single `tags` property
  - Old: `$ipn->getTag1()`, `$ipn->getTag2()`, etc.
  - New: `$notification->tags` (array with automatic comma-split conversion)

#### Removed
- **BREAKING**: Removed all array helper methods (use direct property access instead):
  - `getAllProductIds()` - Use `$notification->product_id` and `$notification->product_ids`
  - `getAllCouponCodes()` - Use `$notification->coupon_code`
  - `getAllTags()` - Use `$notification->tags` (now returns array directly)
  - `getAllLicenseKeys()` - Use `$notification->license_key`
  - `getAllEticketUrls()` - Use `$notification->eticket_url`
  - `getAllUpgradedProductIds()` - Use `$notification->upgraded_product_id`
  - `getAllCouponAmountsLeft()` - Use `$notification->coupon_amount_left`
  - `getAllCouponAmountsTotal()` - Use `$notification->coupon_amount_total`
- **BREAKING**: Removed `__call()` magic method (no longer needed with Property Hooks)
- Deleted `.github/workflows/release.yml` (redundant with tests.yml)
- Deleted `docs/README.md` (merged into main README.md)

### Added
- **PHP 8.4 Property Hooks** for automatic type conversion and validation
- Automatic type conversions in Property Hooks:
  - String → float, int, bool, DateTimeImmutable, Enum
  - Comma-separated string → array (for `tags` property)
- Zero-reflection architecture for better performance
- Static factory methods: `fromPost()`, `fromGet()`, `fromArray()`
- New `Salutation` enum for type-safe address salutation values ('M', 'F', '')
- Comprehensive inline code documentation with examples and best practices
- Detailed PHPDoc comments explaining Property Hooks and type conversions
- Security notes and usage examples in all major classes
- Comprehensive documentation updates for v2.0
- Migration guide in [docs/UPGRADE.md](docs/UPGRADE.md)

### Performance
- 🚀 **88.3% code reduction** in Notification class (7616 → 891 lines, formerly IPNRequestDto)
- 🚀 **52% code reduction** in DtoHelper (130 → 62 lines)
- ⚡ **No reflection overhead** - direct property access
- ⚡ Property Hooks are compiled for optimal performance

### Documentation
- Updated README.md with PHP 8.4 examples
- Completely rewritten [docs/UPGRADE.md](docs/UPGRADE.md) for v2.0 migration
- Updated all examples in `examples/` directory to use `Notification` class
- Updated examples/README.md with Property Hooks explanation
- All code examples now use snake_case properties and direct access
- Merged docs/README.md content into main README.md
- Enhanced README.md with Development, Documentation, and Questions sections
- Updated CONTRIBUTING.md for PHP 8.4 requirements
- Updated LICENSE copyright to "GoSuccess GmbH"
- Cleaned up documentation folder (removed internal test summaries and reports)
- Kept only user-facing documentation: UPGRADE.md and README.md

### Testing
- All 69 PHPUnit tests passing (100% success rate)
- Fixed integration tests to use authentic Digistore24 field names
- Corrected field names: `email`, `transaction_amount`, `address_first_name`, `pay_method`
- Fixed enum values to match actual Digistore24 enums
- Updated tests for namespace change and class renames
- Configured PHPStan to exclude Notification.php and Response.php (Property Hooks not yet fully supported in PHPStan 2.1.31)

### CI/CD
- Updated GitHub Actions workflows to support PHP 8.4
- Added PHP 8.4 to CI/CD test matrix (8.1, 8.2, 8.3, 8.4)
- Code quality checks now use PHP 8.4

### Migration
See [docs/UPGRADE.md](docs/UPGRADE.md) for complete migration instructions from v1.x to v2.0.

---

## [1.1.2] - 2025-07-31

### Changed
- Updated getter return types in `IPNRequestDto` to return specific enum or value object types instead of strings
- Changed 21 getter methods to return typed objects (e.g., `Action`, `BillingStatus`, `DateTimeImmutable`)
- Improved type safety and API clarity

## [1.1.1] - 2025-07-31

### Fixed
- Corrected namespace of `DtoHelper` from `DHelper` to `Helper`
- Updated import statement in `IPNRequestDto.php` to match corrected namespace

## [1.1.0] - 2025-07-31

### Changed
- Renamed `Event::CHARGEBACK` to `Event::ON_CHARGEBACK` for consistency with naming conventions

### Added
- Added autoload require example in README.md

## [1.0.0] - 2025-07-30

### Added
- Initial release
- Complete IPN request DTO with all Digistore24 fields (500+ properties)
- IPN response DTO for structured responses
- Signature generation and validation (SHA512)
- DTO helper for automatic type casting
- Comprehensive enum support for all IPN constants (17 enums)
- Full PHP 8.1+ type safety
- Exception handling for invalid IPN data
- MIT License

[2.0.0]: https://github.com/GoSuccess-GmbH/digistore24-ipn/compare/v1.1.2...v2.0.0
[1.1.2]: https://github.com/GoSuccess-GmbH/digistore24-ipn/compare/v1.1.1...v1.1.2
[1.1.1]: https://github.com/GoSuccess-GmbH/digistore24-ipn/compare/v1.1.0...v1.1.1
[1.1.0]: https://github.com/GoSuccess-GmbH/digistore24-ipn/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/GoSuccess-GmbH/digistore24-ipn/releases/tag/v1.0.0
