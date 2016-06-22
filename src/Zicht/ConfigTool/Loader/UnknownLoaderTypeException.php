<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Loader;

/**
 * Thrown when there is no loader configured for the specified file type
 */
class UnknownLoaderTypeException extends \UnexpectedValueException
{
}