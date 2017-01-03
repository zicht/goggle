<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Command;

use Symfony\Component\Console;

use Zicht\ConfigTool\Loader;

class ChainCommand extends IOCommand
{
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('chain')
            ->addArgument('files', Console\Input\InputArgument::REQUIRED | Console\Input\InputArgument::IS_ARRAY, 'Files to chain');
    }


    protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
    {
        $writer = $this->getWriter($input);

        $writer->write(
            array_reduce(
                array_map(
                    function ($value) {
                        return Loader\Factory::createLoader(Loader\Factory::guessType($value))->load();
                    },
                    $input->getArgument('files')
                ),
                'array_merge',
                []
            )
        );
    }
}