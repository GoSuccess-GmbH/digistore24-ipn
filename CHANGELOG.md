# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Comprehensive PHPUnit test suite covering all major components
- Magic method `__call()` in `IPNRequestDto` for dynamic getters (reduces code duplication)
- Array helper methods for convenient access to grouped data:
  - `getAllCouponCodes()` - Get all coupon codes as array
  - `getAllProductIds()` - Get all product IDs as array
  - `getAllTags()` - Get all tags as array
  - `getAllEticketUrls()` - Get all e-ticket URLs as array
  - `getAllLicenseKeys()` - Get all license keys as array
  - `getAllUpgradedProductIds()` - Get all upgraded product IDs as array
  - `getAllCouponAmountsLeft()` - Get remaining coupon amounts as array
  - `getAllCouponAmountsTotal()` - Get total coupon amounts as array
- URL validation in `IPNResponseDto` for `setThankyouUrl()` and `addLoginBlock()`
- Enhanced DateTime parsing with multiple format support and error handling
- GitHub Actions CI/CD pipeline for automated testing (PHP 8.1, 8.2, 8.3)
- PHPStan static analysis support
- PHP CS Fixer configuration for code style consistency
- Comprehensive composer scripts for testing and code quality
- Extended `composer.json` with keywords, support links, and dev dependencies
- Complete documentation in `docs/` directory:
  - Upgrade guide
  - Optimizations overview
  - Test results
  - PHPStan analysis
  - Project summary

### Changed
- **Security**: Replaced string comparison with `hash_equals()` in `SignatureHelper` to prevent timing attacks
- Improved `DtoHelper::parseDateTime()` with support for multiple date formats
- Enhanced error handling for invalid date strings (returns null instead of throwing)
- Updated `composer.json` with autoload-dev, scripts, and additional metadata

### Fixed
- DateTime parsing no longer throws exceptions for invalid date strings
- Boolean parsing handles more edge cases correctly
- Return types for `getEticketIsBlocked()`, `getIsGdprCountry()`, and `getOrderIsPaid()` corrected to `?bool`
- PHPStan warnings resolved (0 errors at level 6)

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

[Unreleased]: https://github.com/GoSuccess-GmbH/digistore24-ipn/compare/v1.1.2...HEAD
[1.1.2]: https://github.com/GoSuccess-GmbH/digistore24-ipn/compare/v1.1.1...v1.1.2
[1.1.1]: https://github.com/GoSuccess-GmbH/digistore24-ipn/compare/v1.1.0...v1.1.1
[1.1.0]: https://github.com/GoSuccess-GmbH/digistore24-ipn/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/GoSuccess-GmbH/digistore24-ipn/releases/tag/v1.0.0
