<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer\Impl;

use Zicht\Itertools as iter;

class MarkdownTable extends AbstractTextWriter
{
    /**
     * @{inheritDoc}
     */
    public function write($value)
    {
        $fnStrToSeparator = function ($h) {
            return preg_replace('/./', '-', $h);
        };

        $values = self::toScalarTable($value);
        $headers = iter\iterable($values->first())->keys();

        fprintf($this->outputStream, "%s\n", join(' | ', $headers));
        fprintf($this->outputStream, "%s\n", join(' | ', array_map($fnStrToSeparator, $headers)));
        foreach ($values as $row) {
            fprintf($this->outputStream, "%s\n", join(' | ', $row));
        }
        fprintf($this->outputStream, "\n");
    }
}
