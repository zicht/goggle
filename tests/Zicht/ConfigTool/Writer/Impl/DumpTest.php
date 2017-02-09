<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriterTest;

class DumpTest extends AbstractWriterTest
{
    /**
     * @dataProvider testCases
     */
    public function testWrite($input, $expected)
    {
        $this->doTest(new Dump(), $input, $expected);
    }


    public function testCases()
    {
        return [
            [[], "[]\n"],
            [['a' => 'b'], "array:1 [\n  \"a\" => \"b\"\n]\n"],
        ];
    }
}