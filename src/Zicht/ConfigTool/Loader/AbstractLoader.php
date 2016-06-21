<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Loader;

abstract class AbstractLoader implements LoaderInterface
{
    protected $inputStream;

    public function setInput($input)
    {
        $this->inputStream = $input;
    }
}