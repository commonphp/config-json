# Testing

Install dependencies:

```bash
composer install
```

Run PHPUnit:

```bash
vendor/bin/phpunit
```

On Windows, use `vendor\bin\phpunit.bat`.

This package lists PHP CS Fixer as a dev dependency. If a fixer configuration is present, run checks with:

```bash
vendor/bin/php-cs-fixer fix --dry-run --diff
```

Some permission tests are platform-sensitive and may be skipped on Windows.
