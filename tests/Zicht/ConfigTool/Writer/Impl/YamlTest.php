<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriterTest;

/**
 * Class JsonTest
 * @package Zicht\ConfigTool\Writer\Impl
 */
class YamlTest extends AbstractWriterTest
{
    /**
     * @dataProvider testCases
     */
    public function testWrite($input, $expected)
    {
        $this->doTest(new Yaml(), $input, $expected);
    }


    public function testCases()
    {
        return [
            [['foo' => 'bar'], "foo: bar\n"],
            [['foo' => ['bar' => 'x']], "foo:\n    bar: x\n"]
        ];
    }
}