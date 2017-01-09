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
            ->addOption('strict', '', Console\Input\InputOption::VALUE_NONE)
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
                function ($value, $prop) use ($input) {
                    if (is_scalar($value)) {
                        if ($input->getOption('strict')) {
                            throw new \InvalidArgumentException(sprintf("Can not get property `%s` of scalar type `%s` (%s)", $prop, gettype($value), $value));
                        }
                        return null;
                    }
                    return
                        is_object($value)
                            ? (isset($value->$prop) ? $value->$prop : null)
                            : (isset($value[$prop]) ? $value[$prop] : null)
                    ;
                },
                $loader->load()
            )
        );
    }
}
