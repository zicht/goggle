<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Loader;

/**
 * Base class for loaders
 */
abstract class AbstractLoader implements LoaderInterface
{
    protected $inputStream;

    /**
     * @{inheritDoc}
     */
    public function setInput($input)
    {
        $this->inputStream = $input;
    }
}
