<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Loader\Impl;

use Zicht\ConfigTool\Loader\AbstractLoader;

class Json extends AbstractLoader
{
    public function load()
    {
        return json_decode(stream_get_contents($this->inputStream));
    }
}