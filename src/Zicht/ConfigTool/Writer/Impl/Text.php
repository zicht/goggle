<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriter;

class Text extends AbstractWriter
{
    public function write($value)
    {
        foreach ((array) $value as $v) {
            fwrite($this->outputStream, "$v\n");
        }
    }
}