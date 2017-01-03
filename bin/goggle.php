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

(new Application())->run();

