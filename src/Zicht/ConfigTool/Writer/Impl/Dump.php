<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriter;
use Zicht\Util\Debug;

class Dump extends AbstractWriter
{
    public function write($value)
    {
        fwrite($this->outputStream, Debug::dump($value));
   }
}