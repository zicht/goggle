<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Writer;

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\StreamOutput;
use Zicht\ConfigTool\Application;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    private function app($args)
    {
        $application = new Application();
        $application->setAutoExit(false);
        $application->setCatchExceptions(false);

        $buffer = fopen("php://temp", "w+");
        $application->run(new ArgvInput(array_merge([__FILE__], $args)), new StreamOutput($buffer));
        fseek($buffer, 0);
        return stream_get_contents($buffer);
    }

    /**
     * @dataProvider testCases
     */
    public function tests($args, $expectedOutput, $expectedException = null)
    {
        if ($expectedException) {
            $this->expectException($expectedException);
        }

        $this->assertEquals($expectedOutput, $this->app($args));
    }


    public function testCases()
    {
        return [
            [['get', '-i', __DIR__ . '/assets/json.json', 'a'], '"b"' . "\n"],
            [['get', '-i', __DIR__ . '/assets/json.json', 'a', '-O', 'text'], 'b' . "\n"],
            [['get', '-i', __DIR__ . '/assets/json.json', 'a', 'b',  '-O', 'text'], ''],
            [['get', '--strict', '-i', __DIR__ . '/assets/json.json', 'a', 'b',  '-O', 'text'], '', \InvalidArgumentException::class],

            [['chain', __DIR__ . '/assets/list1.json', __DIR__ . '/assets/list2.json', '-O', 'text'], "a\nb\nc\nd\n"],

            [['process', '-i', __DIR__ . '/assets/simpsons.json', 'filter', 'item["age"] < 20', 'mapBy', 'age', 'ksort', 'fields', 'first_name', '-O', 'text'], "Maggie\nLisa\nBart\n"],
            [['process', '-i', __DIR__ . '/assets/simpsons.json', 'filter', 'item["age"] > 10', 'sortBy', 'name', 'fields', 'first_name', '-O', 'text'], "Homer\nMarge\n"],
            [['process', '-i', __DIR__ . '/assets/simpsons.json', 'filter', 'item["age"] > 10', 'sortBy', 'age', 'fields', 'first_name', '-O', 'text'], "Marge\nHomer\n"],
            [['process', '-i', __DIR__ . '/assets/simpsons.json', 'map', 'last_name', 'unique', '-O', 'text'], "Simpson\n"],
            [['process', '-i', __DIR__ . '/assets/simpsons.json', 'map', 'age', 'sort', '-O', 'text'], "2\n9\n10\n43\n45\n"],
            [['process', '-i', __DIR__ . '/assets/list1.json', 'zip', '-O', 'text'], "0\ta\n1\tb\n"],
            [['process', '-i', __DIR__ . '/assets/list1.json', 'keys', '-O', 'text'], "0\n1\n"],
            [['process', '-i', __DIR__ . '/assets/list1.json', 'unknown command', '-O', 'text'], "", \InvalidArgumentException::class],

            [['set', '-i', __DIR__ . '/assets/json.json', 'x', 'y', '-O', 'json'], "{\n    \"a\": \"b\",\n    \"x\": \"y\"\n}\n"],
            //string
            [['set', '-i', __DIR__ . '/assets/json.json', 'x', '1.0', '-O', 'json'], "{\n    \"a\": \"b\",\n    \"x\": \"1.0\"\n}\n"],
            //bool
            [['set', '-i', __DIR__ . '/assets/json.json', 'x', '1.0', '-t', 'bool', '-O', 'json'], "{\n    \"a\": \"b\",\n    \"x\": true\n}\n"],

            //float
            [['set', '-i', __DIR__ . '/assets/json.json', 'x', '1.0', '-t', 'float', '-O', 'json'], "{\n    \"a\": \"b\",\n    \"x\": 1\n}\n"],
            [['set', '-i', __DIR__ . '/assets/json.json', 'x', '1.1', '-t', 'float', '-O', 'json'], "{\n    \"a\": \"b\",\n    \"x\": 1.1\n}\n"],

            //int
            [['set', '-i', __DIR__ . '/assets/json.json', 'x', '1.1', '-t', 'int', '-O', 'json'], "{\n    \"a\": \"b\",\n    \"x\": 1\n}\n"],
            [['set', '-i', __DIR__ . '/assets/json.json', 'x', '1.1', '-t', 'int', '-O', 'json'], "{\n    \"a\": \"b\",\n    \"x\": 1\n}\n"],
        ];
    }


    public function testEdit()
    {
        $file = sys_get_temp_dir() . '/test.json';
        file_put_contents($file, '{"a": "b"}');
        $this->app(['set', '-e', $file, 'a', 'foo']);
        $this->assertEquals(['a' => 'foo'], json_decode(file_get_contents($file), JSON_OBJECT_AS_ARRAY));
    }
}