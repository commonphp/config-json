<?php /** @noinspection PhpUnused */

namespace CommonPHP\Configuration\Drivers\JsonConfigurationDriver;

use CommonPHP\Configuration\Attributes\ConfigurationDriverAttribute;
use CommonPHP\Configuration\Contracts\ConfigurationDriverContract;
use Exception;
use JsonException;
use Override;

#[ConfigurationDriverAttribute('json')]
class JsonConfigurationDriver implements ConfigurationDriverContract
{
    #[Override] function canSave(): bool
    {
        return true;
    }

    /**
     * @throws JsonException
     * @throws Exception
     */
    #[Override] function load(string $filename): array
    {
        $json = file_get_contents($filename);
        if (!json_validate($json))
        {
            throw new JsonException('Invalid JSON in '.$filename);
        }
        $result = json_decode($json, true);
        if ($result === false)
        {
            throw new Exception('json_decode(...) returned false on '.$filename);
        }
        if ($result === null)
        {
            throw new Exception('json_decode(...) returned *NULL* on '.$filename);
        }
        return $result;
    }

    /**
     * @throws Exception
     */
    #[Override] function save(string $filename, array $data): void
    {
        if (file_put_contents($filename, json_encode($data)) === false)
        {
            throw new Exception('file_put_contents(...) returned false on '.$filename);
        }
    }
}