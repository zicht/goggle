<?php

namespace Zicht\ConfigTool\Loader\Impl;

use Zicht\ConfigTool\Loader\AbstractLoaderTest;

class JsonTest extends AbstractLoaderTest
{
    /**
     * @dataProvider testCases
     * @param $input
     * @param $expected
     */
    public function testLoad($input, $expected)
    {
        $loader = new Json();
        $loader->setInput($this->createBuffer($input));
        $this->assertEquals($expected, $loader->load());
    }


    public function testCases()
    {
        return [
            ["", []],
            ["{}", []],
            ["[]", []],
            ['{"foo": "bar"}', ['foo' => 'bar']],
            ['[{"foo": "bar"}]', [['foo' => 'bar']]]
        ];
    }
}