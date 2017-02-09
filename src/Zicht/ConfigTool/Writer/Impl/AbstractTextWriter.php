<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */


namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriter;
use Zicht\Itertools as iter;

/**
 * Base writer with some helper methods
 */
abstract class AbstractTextWriter extends AbstractWriter
{
    /**
     * Convert all values to a 'scalar', converting any object or array
     * to to a string '<object>' or '<array>' respectively
     *
     * @param mixed[] $record
     * @return string[]
     */
    public static function toScalarValues($record)
    {
        return array_map(
            function ($v) {
                if (!is_scalar($v)) {
                    return '<' . gettype($v) . '>';
                }
                return $v;
            },
            (array)$record
        );
    }


    /**
     * Helper to convert a n-dimensional array with n > 2 to all scalar values
     *    
     * @param mixed[][] $list
     * @return string[][]
     */
    public static function toScalarTable($list)
    {
        return iter\iterable($list)
            ->map(
                function ($record) {
                    return self::toScalarValues($record);
                }
            );
    }
}
