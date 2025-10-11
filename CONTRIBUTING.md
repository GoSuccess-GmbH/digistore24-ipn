# Contributing to Digistore24 IPN PHP Library

First off, thank you for considering contributing to this project! 🎉

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check the existing issues to avoid duplicates.

When you create a bug report, please include:
- A clear and descriptive title
- Steps to reproduce the behavior
- Expected behavior
- Actual behavior
- PHP version and environment details
- Code samples if applicable

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, please include:
- A clear and descriptive title
- Detailed description of the proposed functionality
- Explain why this enhancement would be useful
- Code examples if applicable

### Pull Requests

1. Fork the repo and create your branch from `main`
2. If you've added code that should be tested, add tests
3. Ensure the test suite passes (`composer test`)
4. Make sure your code follows the existing style (`composer cs:check`)
5. Write clear commit messages
6. Update documentation if needed

## Development Setup

```bash
# Clone your fork
git clone https://github.com/YOUR_USERNAME/digistore24-ipn.git
cd digistore24-ipn

# Install dependencies
composer install

# Run tests
composer test

# Check code style
composer cs:check

# Fix code style
composer cs:fix

# Run static analysis
composer analyze
```

## Coding Standards

- Follow PSR-12 coding standards
- Use PHP 8.1+ features (typed properties, enums, etc.)
- Write PHPDoc comments for public methods
- Ensure all public APIs are type-safe
- Add tests for new functionality

## Testing

- Write unit tests for new features
- Ensure all tests pass before submitting PR
- Aim for high code coverage
- Test with multiple PHP versions (8.1, 8.2, 8.3)

```bash
# Run all tests
composer test

# Run tests with coverage
composer test:coverage
```

## Commit Messages

- Use the present tense ("Add feature" not "Added feature")
- Use the imperative mood ("Move cursor to..." not "Moves cursor to...")
- Limit the first line to 72 characters or less
- Reference issues and pull requests liberally after the first line

Examples:
```
Add array helper methods for grouped data

- getAllCouponCodes()
- getAllProductIds()
- getAllTags()

Closes #123
```

## Code Review Process

The maintainers will review your pull request and may request changes. Once approved, your contribution will be merged.

## Documentation

When adding new features, please update the relevant documentation in the `docs/` directory:
- [docs/UPGRADE.md](docs/UPGRADE.md) - For user-facing changes
- [docs/OPTIMIZATIONS.md](docs/OPTIMIZATIONS.md) - For optimization details
- [docs/TEST_RESULTS.md](docs/TEST_RESULTS.md) - For test coverage updates

## Questions?

Feel free to open an issue with your question or reach out to the maintainers.

## License

By contributing, you agree that your contributions will be licensed under the MIT License.
