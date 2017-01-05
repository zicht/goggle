<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */


namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriter;
use Zicht\Itertools as iter;

abstract class AbstractTextWriter extends AbstractWriter
{
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


    public static function toScalarTable($list)
    {
        return iter\iterable($list)
            ->map(function ($record) {
                return self::toScalarValues($record);
            });
    }
}