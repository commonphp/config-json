# CommonPHP JSON Config Driver

Configuration driver for CommonPHP that encodes and decodes JSON configuration data.

## Requirements

- PHP `^8.5`
- `comphp/config:^0.3`

## Installation

Once this package is available through your Composer repositories, install it with:

```bash
composer require comphp/config-json
```

## Usage

```php
<?php

use CommonPHP\Drivers\Config\JSON\JsonConfigurationDriver;

$driver = new JsonConfigurationDriver();

$config = [
    'app' => 'demo',
    'debug' => true,
    'database' => [
        'host' => 'localhost',
    ],
];

$json = $driver->encode($config);
$decoded = $driver->decode($json);

$driver->write(__DIR__ . '/config.json', $config);
$fromFile = $driver->read(__DIR__ . '/config.json');
```

## Format Notes

JSON data must decode to a PHP array. JSON objects and arrays can be configuration containers; scalar JSON values such as `true` or `"hello"` are rejected by `decode()`. `validate()` checks JSON syntax.

## Error Handling

Read, write, parse, validation, and unsupported value failures throw CommonPHP config exceptions such as `ConfigReadException`, `ConfigWriteException`, `ConfigValidationException`, or `ConfigException`.

## Documentation

- [Usage](docs/usage.md)
- [Testing](TESTING.md)
- [Contributing](CONTRIBUTING.md)
- [Security](SECURITY.md)

## License

MIT. See [LICENSE.md](LICENSE.md).
