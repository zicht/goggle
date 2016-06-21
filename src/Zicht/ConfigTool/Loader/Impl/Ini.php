<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Loader\Impl;

use Zicht\ConfigTool\Loader\AbstractLoader;

class Ini extends AbstractLoader
{
    public function load()
    {
        return parse_ini_string(stream_get_contents($this->inputStream), true);
    }
}