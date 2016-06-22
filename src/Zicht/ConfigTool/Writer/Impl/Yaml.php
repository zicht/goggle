<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer\Impl;

use Symfony\Component\Yaml\Yaml as YamlWriter;
use Zicht\ConfigTool\Writer\AbstractWriter;

/**
 * Write data as yaml
 */
class Yaml extends AbstractWriter
{
    /**
     * @{inheritDoc}
     */
    public function write($value)
    {
        fwrite($this->outputStream, YamlWriter::dump($value));
        fwrite($this->outputStream, "\n");
    }
}