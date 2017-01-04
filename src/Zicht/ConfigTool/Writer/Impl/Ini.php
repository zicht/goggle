<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriter;

/**
 * Writes the value as an ini file
 */
class Ini extends AbstractWriter
{
    /**
     * @{inheritDoc}
     */
    public function write($value)
    {
        foreach ((array)$value as $k => $v) {
            if (is_scalar($v)) {
                fprintf($this->outputStream, "%s = %s\n", $k, $v);
            } else {
                fprintf($this->outputStream, "[%s]\n", $k);
                foreach ((array)$v as $subKey => $subValue) {
                    if (!is_scalar($subValue)) {
                        throw new \UnexpectedValueException("Can not serialize a non-scalar in an ini file");
                    }
                    fprintf($this->outputStream, "%s = %s\n", $subKey, $subValue);
                }
            }
        }
    }
}
