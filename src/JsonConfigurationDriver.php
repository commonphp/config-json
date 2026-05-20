<?php

declare(strict_types=1);

namespace CommonPHP\Drivers\Config\JSON;

use CommonPHP\Config\Contracts\AbstractConfigDriver;
use CommonPHP\Config\Exceptions\ConfigException;
use CommonPHP\Config\Exceptions\ConfigValidationException;
use JsonException;
use Throwable;

final class JsonConfigurationDriver extends AbstractConfigDriver
{
    public function validate(string $data): bool
    {
        try {
            $this->decode($data);

            return true;
        } catch (Throwable) {
            return false;
        }
    }

    public function encode(array $config): string
    {
        try {
            return json_encode(
                $config,
                JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            );
        } catch (JsonException $e) {
            throw new ConfigException('Could not encode JSON configuration data.', $e->getCode(), $e);
        }
    }

    public function decode(string $data): array
    {
        try {
            $decoded = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new ConfigValidationException('Invalid JSON configuration data.', $e->getCode(), $e);
        }

        if (!is_array($decoded)) {
            throw new ConfigValidationException('JSON configuration data must decode to an array.');
        }

        return $decoded;
    }
}
