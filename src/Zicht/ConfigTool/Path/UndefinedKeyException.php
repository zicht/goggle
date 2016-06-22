<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Path;

use UnexpectedValueException;

/**
 * Thrown when a key in the path is not found in the current array position
 */
class UndefinedKeyException extends UnexpectedValueException
{
    /**
     * Constructor
     *
     * @param string $elementName
     * @param array $path
     * @param int $code
     * @param \Exception|null $prev
     */
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