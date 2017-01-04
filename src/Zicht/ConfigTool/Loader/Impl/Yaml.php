<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Loader\Impl;

use Zicht\ConfigTool\Loader\AbstractLoader;
use Symfony\Component\Yaml\Yaml as YamlParser;

/**
 * Loads yaml files
 */
class Yaml extends AbstractLoader
{
    /**
     * @{inheritDoc}
     */
    public function load()
    {
        return YamlParser::parse(stream_get_contents($this->inputStream));
    }
}
