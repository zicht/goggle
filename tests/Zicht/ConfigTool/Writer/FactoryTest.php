<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer;

class FactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        foreach (Factory::supportedTypes() as $type) {
            $this->assertInstanceOf(WriterInterface::class, Factory::createWriter($type));
        }
    }

    /**
     * @expectedException Zicht\ConfigTool\Writer\UnknownWriterTypeException
     */
    public function testInvalidType()
    {
        Factory::createWriter('this is not valid');
    }
}