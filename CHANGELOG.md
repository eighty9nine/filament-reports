# Changelog

All notable changes to `filament-reports` will be documented in this file.

## [Unreleased]

### Added
- Laravel 12.0 support
- PHP 8.3 support in CI/CD pipeline

### Changed
- **BREAKING:** Updated minimum PHP requirement to 8.2 (required for Laravel 12)
- Updated illuminate/contracts to support ^10.0|^11.0|^12.0
- Updated testing dependencies for Laravel 12 compatibility:
  - orchestra/testbench: ^8.0|^9.0|^10.0
  - pestphp/pest: ^2.0|^3.0
  - pestphp/pest-plugin-arch: ^2.0|^3.0
  - pestphp/pest-plugin-laravel: ^2.0|^3.0
  - nunomaduro/collision: ^7.9|^8.0
- Updated GitHub Actions workflow to test against Laravel 10, 11, and 12
- Updated GitHub Actions workflow to test PHP 8.2 and 8.3 (removed PHP 8.1)

## 1.0.0 - 202X-XX-XX

- initial release
