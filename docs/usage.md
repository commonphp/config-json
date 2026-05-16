# Usage

`comphp/config-json` provides `CommonPHP\Drivers\Config\JSON\JsonConfigurationDriver` for JSON configuration files.

## Encode and Decode

```php
use CommonPHP\Drivers\Config\JSON\JsonConfigurationDriver;

$driver = new JsonConfigurationDriver();

$config = [
    'name' => 'demo',
    'database' => [
        'host' => 'localhost',
    ],
];

$data = $driver->encode($config);
$decoded = $driver->decode($data);
```

## Read and Write

```php
$driver->write(__DIR__ . '/config.json', $config);
$config = $driver->read(__DIR__ . '/config.json');
```

## Notes

Decoded JSON must produce a PHP array. Scalar-only JSON is not accepted as a configuration array.

Failures throw CommonPHP config exceptions instead of returning `false`.
