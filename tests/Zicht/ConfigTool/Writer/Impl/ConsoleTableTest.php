<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\ConfigTool\Writer\AbstractWriterTest;

class ConsoleTableTest extends AbstractWriterTest
{
    /**
     * @dataProvider testCases
     */
    public function testWrite($input, $expected)
    {
        $this->doTest(new ConsoleTable(), $input, $expected);
    }


    public function testCases()
    {
        return [
            [[], ""],
            [
                [['x' => 'a', 'y' => 'b']],
                "+---+---+\n" .
                "| x | y |\n" .
                "+---+---+\n" .
                "| a | b |\n" .
                "+---+---+\n"
            ],
            [
                [
                    ['x' => 'a', 'y' => 'b'],
                    ['x' => 'c', 'y' => 'd']
                ],
                "+---+---+\n" .
                "| x | y |\n" .
                "+---+---+\n" .
                "| a | b |\n" .
                "| c | d |\n" .
                "+---+---+\n"
            ],
        ];
    }
}