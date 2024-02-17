# JSON Configuration Driver for CommonPHP

This library provides a JSON configuration driver, `JsonConfigurationDriver`, which implements the `ConfigurationDriverContract` from the CommonPHP Configuration Management library. It enables applications to load and save configurations in JSON format, leveraging the CommonPHP Driver Management system for seamless integration.

## Features

- **Load JSON Configurations**: Effortlessly read and decode JSON files into associative arrays.
- **Save Configurations as JSON**: Serialize and save PHP associative arrays back into JSON format files.
- **JSON Validation**: Ensures the integrity of the JSON content during the loading process.
- **Exception Handling**: Comprehensive error and exception handling for common JSON parsing issues.

## Installation

Use Composer to install the Configuration Manager and this driver:

```
composer require comphp/config
composer require comphp/config-json
```

## Usage

First, ensure that your `DriverManager` instance is configured to recognize the JSON driver:

```php
use CommonPHP\Drivers\DriverManager;
use CommonPHP\Configuration\Drivers\JsonConfigurationDriver\JsonConfigurationDriver;

$driverManager = new DriverManager();
$driverManager->enable(JsonConfigurationDriver::class);
```

Then, when using the Configuration Manager to load or save a JSON file, the `JsonConfigurationDriver` will automatically be utilized for `.json` extensions, thanks to the `#[ConfigurationDriverAttribute('json')]` attribute.

### Loading a Configuration File

```php
$configManager->loadDriver(JsonConfigurationDriver::class);
$config = $configManager->get('path/to/configuration.json');
```

### Saving a Configuration File

Ensure the driver has been loaded as shown above, then:

```php
$config->data['newKey'] = 'newValue';
$config->save(); // Saves the modifications back to 'path/to/configuration.json'
```

## Exception Handling

- **JsonException**: Thrown if the JSON file contains invalid JSON.
- **Exception**: General exceptions for file read/write failures or JSON decoding issues.

This driver provides a simple yet powerful means to work with JSON-based configurations within the CommonPHP framework, ensuring flexibility and ease of use for developers.