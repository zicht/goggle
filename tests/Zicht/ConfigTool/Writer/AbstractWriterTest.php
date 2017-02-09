<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer;

abstract class AbstractWriterTest extends \PHPUnit_Framework_TestCase
{
    public function doTest(WriterInterface $writer, $input, $expected)
    {
        $buffer = fopen("php://memory", "w+");
        $writer->setOutput($buffer);
        $writer->write($input);
        fseek($buffer, 0);
        $this->assertEquals($expected, stream_get_contents($buffer));
    }
}