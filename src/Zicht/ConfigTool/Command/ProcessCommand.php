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
class ProcessCommand extends IOCommand
{
    /**
     * @{inheritDoc}
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('process')
            ->setDescription("Process a data set recursively")
            ->setHelp(
                'Each instruction is a certain operation on the data set'
            )
            ->addArgument(
                'instructions', Console\Input\InputArgument::IS_ARRAY, 'The item to read from the config, i.e. `parameters`'
            );
    }

    /**
     * @{inheritDoc}
     */
    protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
    {
        $loader = $this->getLoader($input);
        $writer = $this->getWriter($input);

        $instructions = $input->getArgument('instructions');

        $shift = function () use (&$instructions) {
            return array_shift($instructions);
        };

        $data = iter\iterable($loader->load());
        while ($instruction = $shift()) {
            switch ($instruction) {
                case 'map':
                case 'mapBy':
                    $func = new \ReflectionFunction("Zicht\\Itertools\\" . $instruction);
                    $data = $func->invoke($shift(), $data);
                    break;
                case 'keys':
                case 'count':
                case 'values':
                    $data = iter\iterable($data)->$instruction();
                    break;
                default:
                    throw new \InvalidArgumentException("Undefined process token `$instruction`\n");
            }
        }

        $writer->write($data->toArray());
    }
}