<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Loader;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        foreach (Factory::supportedTypes() as $type) {
            $this->assertInstanceOf(LoaderInterface::class, Factory::createLoader($type));
        }
    }

    /**
     * @expectedException \Zicht\ConfigTool\Loader\UnknownLoaderTypeException
     */
    public function testInvalidType()
    {
        Factory::createLoader('this is not valid');
    }


    /**
     * @dataProvider types
     */
    public function testGuess($filename, $expectedType)
    {
        $this->assertEquals($expectedType, Factory::guessType($filename));
    }

    public function types()
    {
        return [
            ['foo.json', Factory::JSON],
            ['composer.lock', Factory::JSON],
            ['foo.yaml', Factory::YAML],
            ['foo.yml', Factory::YAML],
            ['.my.cnf', Factory::INI],
            ['foo.ini', Factory::INI],
            ['unknown.zip', null],
        ];
    }
}