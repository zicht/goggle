<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Loader\Impl;

use Zicht\ConfigTool\Loader\AbstractLoader;

/**
 * Loads json files
 */
class Json extends AbstractLoader
{
    /**
     * @{inheritDoc}
     */
    public function load()
    {
        return json_decode(stream_get_contents($this->inputStream));
    }
}