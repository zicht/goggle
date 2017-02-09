<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriterTest;

class MarkdownTest extends AbstractWriterTest
{
    /**
     * @dataProvider testCases
     */
    public function testWrite($input, $expected)
    {
        $this->doTest(new MarkdownTable(), $input, $expected);
    }


    public function testCases()
    {
        return [
            [[], "\n"],
            [
                [['x' => 'a', 'y' => 'b']],
                "x | y\n" .
                "- | -\n" .
                "a | b\n\n"
            ],
            [
                [
                    ['x' => 'a', 'y' => 'b'],
                    ['x' => 'c', 'y' => 'd']
                ],
                "x | y\n" .
                "- | -\n" .
                "a | b\n" .
                "c | d\n\n"
            ],
        ];
    }
}