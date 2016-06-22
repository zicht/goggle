<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Loader;

/**
 * Factory for different loader types.
 */
class Factory
{
    /** YAML format */
    const YAML = 'yaml';

    /** JSON format */
    const INI = 'ini';

    /** INI format */
    const JSON = 'json';

    /**
     * Try to guess a file type based on its name
     *
     * @param string $file
     * @return null|string
     */
    public static function guessType($file)
    {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        switch (true) {
            case $ext === 'json':
            case basename($file) === 'composer.lock':
                return self::JSON;
            case $ext === 'yml':
            case $ext === 'yaml':
                return self::YAML;
            case $ext === 'ini':
            case basename($file) === '.my.cnf':
                return self::INI;
        }

        return null;
    }


    /**
     * Create a loader for the specified type
     *
     * @param string $type
     * @return LoaderInterface
     */
    public static function createLoader($type)
    {
        switch ($type) {
            case self::JSON:
                return new Impl\Json();
            case self::YAML:
                return new Impl\Yaml();
            case self::INI:
                return new Impl\Ini();
        }

        throw new UnknownLoaderTypeException("Sorry, loader type `{$type}` is unsupported");
    }
}