<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */


namespace Zicht\ConfigTool\Path;


class ValueHasNoPropertiesException extends \UnexpectedValueException
{
    public function __construct($elementName, array $path, $code = 0, \Exception $prev = null)
    {
        parent::__construct(
            sprintf('Element at path `%s` is not an object or array, so it has no property `%s`',
                join(' ', $path),
                $elementName
            ),
            $code,
            $prev
        );
    }
}