<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer;

class Factory
{
    const JSON = 'json';
    const YAML = 'yaml';
    const INI = 'ini';
    const COLUMNS = 'text';
    const DUMP = 'dump';
    const KEYS = 'keys';

    /**
     * @param $type
     * @return WriterInterface
     */
    public static function createWriter($type)
    {
        switch ($type) {
            case self::JSON:
                return new Impl\Json();
            case self::YAML:
                return new Impl\Yaml();
            case self::INI:
                return new Impl\Ini();
            case self::COLUMNS:
                return new Impl\Columns();
            case self::DUMP:
                return new Impl\Dump();
            case self::KEYS:
                return new Impl\Keys();
        }

        throw new UnknownWriterTypeException("Sorry, writer type {$type} is not something I do");
    }
}