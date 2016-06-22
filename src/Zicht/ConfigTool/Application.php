<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool;

use Symfony\Component\Console\Application as BaseApplication;

/**
 * Main CLI application
 */
class Application extends BaseApplication
{
    /**
     * @var string
     */
    public static $VERSION = 'dev';

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('Goggle', self::$VERSION);

        $this->add(new Command\GetCommand());
    }
}