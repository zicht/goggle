<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriterTest;

class JsonTest extends AbstractWriterTest
{
    /**
     * @dataProvider testCases
     */
    public function testWrite($input, $expected)
    {
        $this->doTest(new Json(), $input, $expected);
    }


    public function testCases()
    {
        return [
            [[], "[]\n"],
            [['foo' => 'bar'], "{\n    \"foo\": \"bar\"\n}\n"],
        ];
    }
}