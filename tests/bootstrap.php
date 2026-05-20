<?php

declare(strict_types=1);

$packageRoot = dirname(__DIR__);
$workspaceRoot = dirname($packageRoot, 3);
$autoloads = [
    $packageRoot . '/vendor/autoload.php',
    $workspaceRoot . '/vendor/autoload.php',
];
$envAutoload = getenv('COMMONPHP_TEST_AUTOLOAD') ?: '';

if ($envAutoload !== '') {
    $autoloads[] = $envAutoload;
}

$autoload = null;

foreach ($autoloads as $candidate) {
    if (is_file($candidate)) {
        $autoload = $candidate;
        break;
    }
}

if ($autoload === null) {
    throw new RuntimeException(
        'Composer dependencies are not installed. Run `composer install` before running the test suite.',
    );
}

require $autoload;

spl_autoload_register(static function (string $class) use ($packageRoot): void {
    $prefix = 'CommonPHP\\Drivers\\Config\\JSON\\Tests\\';

    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relativePath = str_replace('\\', '/', substr($class, strlen($prefix)));
    $file = $packageRoot . '/tests/' . $relativePath . '.php';

    if (is_file($file)) {
        require $file;
    }
});
