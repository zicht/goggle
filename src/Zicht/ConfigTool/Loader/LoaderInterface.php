<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Loader;

interface LoaderInterface
{
    public function load();

    public function setInput($stream);
}