<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Command;

use Symfony\Component\Console;

use Zicht\ConfigTool\Loader;
use Zicht\ConfigTool\Writer;

abstract class IOCommand extends Console\Command\Command
{
    /**
     * @{inheritDoc}
     */
    protected function configure()
    {
        $this
            ->addOption('input', 'i', Console\Input\InputOption::VALUE_REQUIRED, 'The file to read (default is STDIN)', 'php://stdin')
            ->addOption('output', 'f', Console\Input\InputOption::VALUE_REQUIRED, 'The file to write to', 'php://stdout')
            ->addOption('input-format', 't', Console\Input\InputOption::VALUE_REQUIRED, 'Input format (one of: ' . join(', ', Loader\Factory::supportedTypes()) . ')', null)
            ->addOption('output-format', 'o', Console\Input\InputOption::VALUE_REQUIRED, 'Output format (one of: ' . join(', ', Writer\Factory::supportedTypes()) . ')', 'json');
    }

    /**
     * Get the loader based on input parameters
     *
     * @param Console\Input\InputInterface $input
     * @return Loader\LoaderInterface
     */
    protected function getLoader(Console\Input\InputInterface $input)
    {
        $inputFile = $input->getOption('input');

        if ($inputFile === '-') {
            $inputFile = 'php://stdin';
            if (!($inputFormat = $input->getOption('input-format'))) {
                $inputFormat = 'json';
            }
        } elseif (!($inputFormat = $input->getOption('input-format'))) {
            // guess type based on extension.
            $inputFormat = Loader\Factory::guessType($inputFile);
        }

        $loader = Loader\Factory::createLoader($inputFormat);
        $inputStream = fopen($inputFile, 'r');
        if (!$inputStream) {
            throw new \RuntimeException("Could not open input");
        }
        $loader->setInput($inputStream);
        return $loader;
    }

    /**
     * Get the writer based on output parameters
     *
     * @param Console\Input\InputInterface $input
     * @return Writer\WriterInterface
     */
    protected function getWriter(Console\Input\InputInterface $input)
    {
        $writer = Writer\Factory::createWriter($input->getOption('output-format'));
        $writer->setOutput(fopen($input->getOption('output'), 'w'));
        return $writer;
    }
}