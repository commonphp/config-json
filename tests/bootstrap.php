<?php

declare(strict_types=1);

$autoload = dirname(__DIR__) . '/vendor/autoload.php';

if (is_file($autoload)) {
    require $autoload;

    return;
}

$autoload = getenv('COMMONPHP_TEST_AUTOLOAD') ?: '';

if ($autoload !== '' && is_file($autoload)) {
    require $autoload;

    return;
}

throw new RuntimeException(
    'Composer autoload file not found. Run "composer install" before running the test suite.'
);
