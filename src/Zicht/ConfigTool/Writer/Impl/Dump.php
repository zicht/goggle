<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer\Impl;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
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
        $dumper = new CliDumper();
        $dumper->setOutput($this->outputStream);
        $dumper->dump((new VarCloner())->cloneVar($value));
    }
}
