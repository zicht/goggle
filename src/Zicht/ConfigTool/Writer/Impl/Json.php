<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriter;

class Json extends AbstractWriter
{
    public function write($value)
    {
        fwrite($this->outputStream, json_encode($value, JSON_PRETTY_PRINT));
        fwrite($this->outputStream, "\n");
    }
}