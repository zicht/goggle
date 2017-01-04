<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer;

/**
 * Base writer class.
 */
abstract class AbstractWriter implements WriterInterface
{
    protected $outputStream;
    protected $properties;

    /**
     * @{inheritDoc}
     */
    public function setOutput($outputStream)
    {
        $this->outputStream = $outputStream;
    }
}
