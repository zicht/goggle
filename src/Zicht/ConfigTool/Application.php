<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    public static $VERSION = 'dev';

    public function __construct()
    {
        parent::__construct('Zicht configtool', self::$VERSION);

        $this->add(new Command\GetCommand());
    }
}