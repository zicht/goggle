<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer;

/**
 * Interface for writer objects.
 */
interface WriterInterface
{
    /**
     * Set the output stream to write to.
     *
     * @param resource $outputStream
     * @return void
     */
    public function setOutput($outputStream);

    /**
     * Write the value to the previously specified output
     *
     * @param mixed $value
     * @return void
     */
    public function write($value);
}
