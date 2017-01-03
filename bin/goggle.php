<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
use Zicht\ConfigTool\Application;

$autoload = array_shift(
    array_filter(
        [__DIR__ . '/../vendor/autoload.php', __DIR__ . '/../../../autoload.php'], 
        'is_file'
    )
);

if (!$autoload) {
    fprintf(STDERR, "No autoloader found.\n");
    fprintf(STDERR, "You probably need to do a `composer install` within %s\n", realpath(__DIR__ . '/../'));
    exit(250);
}
require_once $autoload;

///**
// * @author Gerard van Helden <gerard@zicht.nl>
// * @copyright Zicht Online <http://zicht.nl>
// */
//
//
//require_once 'vendor/autoload.php';
//
//use Zicht\Itertools as iter;
//use Symfony\Component\Console\Input;
//

(new Application())->run();


//
//
///**
// * @param $file
// * @return iter\lib\IterableIterator
// */
//function parseFile($file)
//{
//    return json_decode(file_get_contents($file), JSON_OBJECT_AS_ARRAY);
//}
//
//$shift = function () {
//    return array_shift($_SERVER['argv']);
//};
//
//// remove first arg
//$shift();
//
//$command = $shift();
//switch ($command) {
//    case 'process':
//        $data = parseFile("php://stdin");
//
//        while ($token = $shift()) {
//            switch ($token) {
//                case 'map':
//                case 'mapBy':
//                    $func = new ReflectionFunction("Zicht\\Itertools\\" . $token);
//                    $data = $func->invoke($shift(), $data);
//                    break;
//                case 'keys':
//                case 'count':
//                case 'values':
//                    $data = iter\iterable($data)->$token();
//                    break;
//                default:
//                    fprintf(STDERR, "Undefined process token `$token`\n");
//                    exit(-1);
//            }
//        }
//        break;
//    case 'chain':
//        $data = array_reduce(
//            array_map(
//                function ($value) {
//                    return parseFile($value);
//                },
//                $_SERVER['argv']
//            ),
//            'array_merge',
//            []
//        );
//        break;
//    case 'text':
//        echo join("\n", iter\iterable(parseFile("php://stdin"))->toArray());
//        return;
//
//    case 'get':

//        break;
//    default:
//        fprintf(STDERR, "Undefined command `$token`\n");
//        exit(-1);
//}
//
//if (is_scalar($data)) {
//    echo $data;
//} else {
//    echo json_encode(iter\iterable($data)->toArray(), JSON_PRETTY_PRINT);
//}
//
//echo "\n";

