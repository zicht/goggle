<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Loader\Impl;

use Zicht\ConfigTool\Loader\AbstractLoader;

/**
 * Loads ini files
 */
class Ini extends AbstractLoader
{
    /**
     * @{inheritDoc}
     */
    public function load()
    {
        return parse_ini_string(stream_get_contents($this->inputStream), true);
    }
}
