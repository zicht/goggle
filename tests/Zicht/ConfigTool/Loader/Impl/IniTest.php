<?php

namespace Zicht\ConfigTool\Loader\Impl;

use Zicht\ConfigTool\Loader\AbstractLoaderTest;

class IniTest extends AbstractLoaderTest
{
    /**
     * @dataProvider testCases
     * @param $input
     * @param $expected
     */
    public function testLoad($input, $expected)
    {
        $loader = new Ini();
        $loader->setInput($this->createBuffer($input));
        $this->assertEquals($expected, $loader->load());
    }


    public function testCases()
    {
        return [
            ["", []],
            ["a=b", ['a' => 'b']],
            ["[foo]\na=b", ['foo' => ['a' => 'b']]]
        ];
    }
}