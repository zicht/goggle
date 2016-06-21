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
    const TXT = 'text';
    const DUMP = 'dump';

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
            case self::TXT:
                return new Impl\Text();
            case self::DUMP:
                return new Impl\Dump();
        }

        throw new UnknownWriterTypeException("Sorry, writer type {$type} is not something I do");
    }
}