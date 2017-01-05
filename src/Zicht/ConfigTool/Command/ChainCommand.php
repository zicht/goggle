<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Command;

use Symfony\Component\Console;

use Zicht\ConfigTool\Loader;

/**
 * Command to merge multiple files' contents into one.
 */
class ChainCommand extends IOCommand
{
    /**
     * @{inheritDoc}
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('chain')
            ->setDescription("Chain (merge) multiple sets of input together")
            ->addOption('list', 'l', Console\Input\InputOption::VALUE_OPTIONAL, 'Wether to wrap each argument\'s result as a list (i.e., consider the contents of the file the first element of a list)')
            ->addArgument('files', Console\Input\InputArgument::REQUIRED | Console\Input\InputArgument::IS_ARRAY, 'Files to chain');
    }


    /**
     * @{inheritDoc}
     */
    protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
    {
        $writer = $this->getWriter($input);

        $writer->write(
            array_reduce(
                array_map(
                    function ($value) use ($input) {
                        $format = $input->getOption('input-format');

                        if (!$format) {
                            $format = Loader\Factory::guessType($value);
                        }

                        $loader = Loader\Factory::createLoader($format);
                        $fd = fopen($value, 'r');
                        if (!$fd) {
                            throw new \InvalidArgumentException("Could not read input file `$value`");
                        }
                        $loader->setInput($fd);

                        $ret = $loader->load();
                        if ($input->getOption('list')) {
                            $ret = [$ret];
                        }
                        if (!is_array($ret)) {
                            throw new \UnexpectedValueException("Loader did not result in an array: {$value}");
                        }
                        return $ret;
                    },
                    $input->getArgument('files')
                ),
                'array_merge',
                []
            )
        );
    }
}
