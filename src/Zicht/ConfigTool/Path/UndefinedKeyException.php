<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Path;

use UnexpectedValueException;

class UndefinedKeyException extends UnexpectedValueException
{
    public function __construct($elementName, array $path, $code = 0, \Exception $prev = null)
    {
        parent::__construct(
            sprintf('Element at path `%s` has no key `%s`',
                join(' ', $path),
                $elementName
            ),
            $code,
            $prev
        );
    }
}