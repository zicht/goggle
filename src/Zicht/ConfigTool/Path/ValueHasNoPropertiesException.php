<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Path;

/**
 * Thrown when the current path needle points to a scalar value, but it is tried to get a value from that.
 */
class ValueHasNoPropertiesException extends \UnexpectedValueException
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
            sprintf('Element at path `%s` is not an object or array, so it has no property `%s`',
                join(' ', $path),
                $elementName
            ),
            $code,
            $prev
        );
    }
}