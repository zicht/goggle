<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriter;

/**
 * Columns output: writes all values as a tabular layout
 */
class Columns extends AbstractTextWriter
{
    /**
     * @{inheritDoc}
     */
    public function write($value)
    {
        foreach ((array)$value as $row) {
            fprintf(
                $this->outputStream,
                "%s\n",
                join("\t", self::toScalarValues($row))
            );
        }
    }
}
