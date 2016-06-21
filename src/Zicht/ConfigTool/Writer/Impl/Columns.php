<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriter;

class Columns extends AbstractWriter
{
    public function write($value)
    {
        foreach ((array)$value as $row) {
            fprintf($this->outputStream, "%s\n", join("\t", array_map(function($v) {
                if (!is_scalar($v)) {
                    return '<' . gettype($v) . '>';
                }
                return $v;
            }, (array)$row)));
        }
    }
}