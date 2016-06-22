<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriter;

/**
 * Writes only all keys of the value to stdout.
 *
 * This is mainly useful for piping.
 */
class Keys extends AbstractWriter
{
    /**
     * @{inheritDoc}
     */
    public function write($value)
    {
        foreach ((array)$value as $k => $v) {
            fwrite($this->outputStream, "$k\n");
        }
    }
}