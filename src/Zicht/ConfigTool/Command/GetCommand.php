<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Command;

use Symfony\Component\Console;
use Zicht\Itertools as iter;

/**
 * Gets a value from a config file and outputs it using any supported format
 */
class GetCommand extends IOCommand
{
    /**
     * @{inheritDoc}
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('get')
            ->setDescription("Get a config value from a file")
            ->addArgument('path', Console\Input\InputArgument::IS_ARRAY, 'The item to read from the config, i.e. `parameters`');
    }

    /**
     * @{inheritDoc}
     */
    protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
    {
        $loader = $this->getLoader($input);
        $writer = $this->getWriter($input);

        $writer->write(
            iter\reduce(
                $input->getArgument('path'),
                function ($value, $prop) {
                    return is_object($value) ? $value->$prop : $value[$prop];
                },
                $loader->load()
            )
        );
    }
}
