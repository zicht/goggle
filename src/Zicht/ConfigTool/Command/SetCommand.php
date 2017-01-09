<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Command;

use Symfony\Component\Console;
use Zicht\Itertools as iter;
use Zicht\Util\TreeTools;

/**
 * Gets a value from a config file and outputs it using any supported format
 */
class SetCommand extends IOCommand
{
    /**
     * @{inheritDoc}
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('set')
            ->addOption('strict', '', Console\Input\InputOption::VALUE_NONE)
            ->addArgument('path', Console\Input\InputArgument::IS_ARRAY, 'Path to following when setting the value. Last item in the path is the value');
    }

    /**
     * @{inheritDoc}
     */
    protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
    {
        $loader = $this->getLoader($input);
        $writer = $this->getWriter($input);

        $path = $input->getArgument("path");
        $value = array_pop($path);
        $obj = $loader->load();

        TreeTools::setByPath($obj, $path, $value);
        $writer->write($obj);
    }
}
