<?php /** @noinspection PhpUnused */

/**
 * JsonConfigurationDriver class is responsible for loading and saving JSON configuration files.
 *
 * The class implements the ConfigurationDriverContract interface.
 *
 * @package CommonPHP\Configuration\Drivers\JsonConfigurationDriver
 */

namespace CommonPHP\Configuration\Drivers\JsonConfigurationDriver;

use CommonPHP\Configuration\Attributes\ConfigurationDriverAttribute;
use CommonPHP\Configuration\Contracts\ConfigurationDriverContract;
use CommonPHP\Configuration\Exceptions\ConfigurationException;
use Override;

/**
 * JsonConfigurationDriver class is responsible for loading and saving JSON configuration files.
 *
 * The class implements the ConfigurationDriverContract interface.
 *
 * JsonConfigurationDriver has the following attributes:
 * - #[ConfigurationDriverAttribute('json')]: Specifies that this driver handles JSON configuration files.
 *
 * The class has the following public methods:
 * - canSave(): bool - Overrides the method from the parent interface and returns true.
 * - load(string $filename): array - Loads the JSON configuration file and returns the decoded content as an array.
 * - save(string $filename, array $data): void - Saves the given data to a file in JSON format.
 *
 * The class also throws a ConfigurationException if there are any errors during the loading or saving process.
 */
#[ConfigurationDriverAttribute('json')]
class JsonConfigurationDriver implements ConfigurationDriverContract
{
    /**
     * Determines whether the configuration can be saved.
     *
     * @return bool Whether the configuration can be saved.
     */
    #[Override] function canSave(): bool
    {
        return true;
    }

    /**
     * Loads the JSON configuration file and returns the decoded content as an array.
     *
     * @param string $filename The path to the JSON configuration file to load.
     *
     * @return array The decoded content of the JSON configuration file.
     *
     * @throws ConfigurationException If the JSON file is invalid or cannot be decoded.
     */
    #[Override] function load(string $filename): array
    {
        $json = file_get_contents($filename);
        if (!json_validate($json))
        {
            throw new ConfigurationException('Invalid JSON in '.$filename);
        }
        $result = json_decode($json, true);
        if ($result === false)
        {
            throw new ConfigurationException('json_decode(...) returned false on '.$filename);
        }
        if ($result === null)
        {
            throw new ConfigurationException('json_decode(...) returned *NULL* on '.$filename);
        }
        return $result;
    }

    /**
     * Saves the given data to a file in JSON format.
     *
     * @param string $filename The path of the file to save the data to.
     * @param array $data The data to be saved in JSON format.
     *
     * @throws ConfigurationException If an error occurs while saving the data.
     */
    #[Override] function save(string $filename, array $data): void
    {
        if (file_put_contents($filename, json_encode($data)) === false)
        {
            throw new ConfigurationException('file_put_contents(...) returned false on '.$filename);
        }
    }
}