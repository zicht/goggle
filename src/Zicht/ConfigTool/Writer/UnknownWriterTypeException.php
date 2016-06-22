<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Writer;

/**
 * Thrown when the writer requested is unknown or unconfigured
 */
class UnknownWriterTypeException extends \UnexpectedValueException
{
}