<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Loader;

class Factory
{
    const JSON = 'json';
    const YAML = 'yaml';
    const INI = 'ini';

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
     * @param $type
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