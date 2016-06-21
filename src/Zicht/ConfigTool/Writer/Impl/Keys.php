<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriter;

class Keys extends AbstractWriter
{
    public function write($value)
    {
        foreach ((array) $value as $k => $v) {
            fwrite($this->outputStream, "$k\n");
        }
    }
}