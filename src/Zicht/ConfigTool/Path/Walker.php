<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Path;

class Walker
{
    public function __construct($value)
    {
        $this->root = $value;
    }


    public function traverse($path)
    {
        $ret = $this->root;
        while ($elementName = array_shift($path)) {
            $position[]= $elementName;

            if (is_object($ret)) {
                if (isset($ret->$elementName)) {
                    $ret = $ret->$elementName;
                } else {
                    throw new UndefinedPropertyException($elementName, $position);
                }
            } elseif (is_array($ret)) {
                if (isset($ret[$elementName])) {
                    $ret = $ret[$elementName];
                } else {
                    throw new UndefinedKeyException($elementName, $position);
                }
            } elseif (is_scalar($ret)) {
                throw new ValueHasNoPropertiesException($elementName, $position);
            }
        }

        return $ret;
    }
}