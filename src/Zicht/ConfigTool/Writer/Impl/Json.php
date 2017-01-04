<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriter;

/**
 * Writes the data as formatted JSON
 */
class Json extends AbstractWriter
{
    /**
     * @{inheritDoc}
     */
    public function write($value)
    {
        fwrite($this->outputStream, json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        fwrite($this->outputStream, "\n");
    }
}
