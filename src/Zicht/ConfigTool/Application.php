<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool;

use Symfony\Component\Console;
use Zicht\ConfigTool\Command;

/**
 * Main CLI application
 */
class Application extends Console\Application
{
    public static $VERSION = 'dev';

    /**
     * @{inheritDoc}
     */
    public function __construct()
    {
        parent::__construct('Zicht Goggle', self::$VERSION);

        $this->addCommands(
            [
                new Command\GetCommand(),
                new Command\ChainCommand(),
                new Command\ProcessCommand()
            ]
        );
    }

    /**
     * @{inheritDoc}
     */
    public function getDefaultInputDefinition()
    {
        return new Console\Input\InputDefinition(
            [
                new Console\Input\InputArgument('command', Console\Input\InputArgument::REQUIRED, 'The command to execute'),

                new Console\Input\InputOption('--help', '-h', Console\Input\InputOption::VALUE_NONE, 'Display this help message'),
                new Console\Input\InputOption('--quiet', '-q', Console\Input\InputOption::VALUE_NONE, 'Do not output any message'),
                new Console\Input\InputOption('--verbose', '-v|vv|vvv', Console\Input\InputOption::VALUE_NONE, 'Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug'),
                new Console\Input\InputOption('--version', '-V', Console\Input\InputOption::VALUE_NONE, 'Display this application version'),
            ]
        );
    }
}
