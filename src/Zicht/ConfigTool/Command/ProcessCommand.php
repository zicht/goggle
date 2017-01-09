<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Command;

use Symfony\Component\Console;
use Symfony\Component\DependencyInjection\ExpressionLanguage;
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
                'Each instruction is a certain operation on the data set, expecting a certain amount of arguments.' . PHP_EOL
                . 'The amount of arguments is hard coded currently, per operation:' . PHP_EOL
                . ' * map: get a property from the dataset (anologous to iter\map)' . PHP_EOL
                . ' * '
            )
            ->addArgument('instructions', Console\Input\InputArgument::IS_ARRAY, 'The item to read from the config, i.e. `parameters`');
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
                case 'fields':
                    // eat up the remainder of the arguments
                    $args = [];
                    while ($arg = $shift()) {
                        $args[] = $arg;
                    }

                    $data = iter\map(
                        function ($record) use ($args) {
                            return iter\filter(
                                function ($value, $key) use ($args) {
                                    return in_array($key, $args);
                                },
                                $record
                            )->toArray();
                        },
                        $data
                    );
                    break;
                case 'filter':
                    // this can probably be done more efficiently than
                    $expr = $shift();
                    $lang = (new ExpressionLanguage())->parse($expr, ['item']);
                    $data = iter\filter(
                        function ($data) use ($lang, $expr) {
                            return $lang->getNodes()->evaluate([], ['item' => $data]);
                        },
                        $data
                    );
                    break;
                case 'unique':
                    $data = iter\unique($shift(), $data);
                    break;
                case 'ksort':
                    $data = iter\sorted(
                        function ($value, $key) {
                            return $key;
                        },
                        $data
                    );
                    break;
                case 'sort':
                    $data = iter\sorted(
                        function ($value) {
                            return $value;
                        },
                        $data
                    );
                    break;
                case 'sortBy':
                    $data = iter\sorted($shift(), $data);
                    break;
                case 'map':
                    $data = iter\map($shift(), $data);
                    break;
                case 'mapBy':
                    $data = iter\mapBy($shift(), $data);
                    break;
                case 'zip':
                    $iterable = iter\iterable($data);
                    $data = iter\zip($iterable->keys(), $iterable->values());
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

        $writer->write(iter\iterable($data)->toArray());
    }
}
