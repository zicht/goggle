<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer\Impl;

use Symfony\Component\VarDumper\VarDumper;
use Zicht\ConfigTool\Writer\AbstractWriter;

/**
 * Dumps an object structure using the Symfony VarDumper.
 */
class Dump extends AbstractWriter
{
    /**
     * @{inheritDoc}
     */
    public function write($value)
    {
        fwrite($this->outputStream, VarDumper::dump($value));
    }
}
