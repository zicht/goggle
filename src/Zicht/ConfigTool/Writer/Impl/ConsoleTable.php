<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer\Impl;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\StreamOutput;
use Zicht\Itertools as iter;
use Zicht\ConfigTool\Writer\AbstractWriter;

/**
 * Writes data as a nicely formatted console table (Symfony Console)
 */
class ConsoleTable extends AbstractTextWriter
{
    /**
     * @{inheritDoc}
     */
    public function write($value)
    {
        $output = new StreamOutput($this->outputStream);

        $values = self::toScalarTable($value);

        $table = new Table($output);
        $table->setHeaders(iter\iterable($values->first())->keys());
        $table = iter\reduce(
            $values,
            function ($table, $row) {
                $table->addRow($row);
                return $table;
            },
            $table
        );

        $table->render();
    }
}
