<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Loader;

abstract class AbstractLoaderTest extends \PHPUnit_Framework_TestCase
{
    protected function createBuffer($input)
    {
        $fd = fopen('php://memory', 'w+');
        fwrite($fd, $input);
        fseek($fd, 0);

        return $fd;
    }
}