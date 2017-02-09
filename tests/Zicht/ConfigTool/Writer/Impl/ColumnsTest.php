<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriterTest;

class ColumnsTest extends AbstractWriterTest
{
    /**
     * @dataProvider testCases
     */
    public function testWrite($input, $expected)
    {
        $this->doTest(new Columns(), $input, $expected);
    }


    public function testCases()
    {
        return [
            [[], ""],
            [[['a', 'b']], "a\tb\n"],
            [[['a', 'b'], ['c', 'd']], "a\tb\nc\td\n"],
            [[['a', new \stdClass]], "a\t<object>\n"],
        ];
    }
}