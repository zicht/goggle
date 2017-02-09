<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriterTest;

class IniTest extends AbstractWriterTest
{
    /**
     * @dataProvider testCases
     */
    public function testWrite($input, $expected)
    {
        $this->doTest(new Ini(), $input, $expected);
    }


    public function testCases()
    {
        return [
            [[], ""],
            [['a' => 'b'], "a = b\n"],
            [['foo' => ['a' => 'b']], "[foo]\na = b\n"]
        ];
    }


    /**
     * @expectedException \Zicht\ConfigTool\Writer\UnsupportedFormatException
     */
    public function testNestedValuesThrowsException()
    {
        $this->doTest(new Ini(), ['a' => ['b' => ['c' => 'too deep']]], null);
    }
}