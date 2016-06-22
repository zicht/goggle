<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer;

/**
 * Class Factory
 */
class Factory
{
    /** YAML output */
    const YAML = 'yaml';

    /** JSON output */
    const JSON = 'json';

    /** INI-file output */
    const INI = 'ini';

    /** Human-readable text output */
    const COLUMNS = 'text';

    /** Human-readable debugging dump output */
    const DUMP = 'dump';

    /** Only output keys (useful for piping/chaining commands) */
    const KEYS = 'keys';

    /**
     * Create a writer for the specified type.
     *
     * @param string $type
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