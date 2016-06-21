<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Zicht\ConfigTool\Path\Walker;
use Zicht\ConfigTool\Loader;
use Zicht\ConfigTool\Writer;

class GetCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('get')
            ->setDescription("Get a config value from a file")
            ->addArgument('file', InputArgument::REQUIRED, 'The file to read')
            ->addArgument('path', InputArgument::IS_ARRAY, 'Config path')
            ->addOption('format', '', InputOption::VALUE_REQUIRED, 'Output format', 'text')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        if ($file === '-') {
            $file = 'php://stdin';
        }

        $loader = Loader\Factory::createLoader(Loader\Factory::guessType($file));
        $loader->setInput(fopen($input->getArgument('file'), 'r'));
        $writer = Writer\Factory::createWriter($input->getOption('format'));

        $writer->setOutput(fopen('php://stdout', 'w'));
        $writer->write(
            (new Walker($loader->load()))
                ->traverse($input->getArgument('path'))
        );
    }
}