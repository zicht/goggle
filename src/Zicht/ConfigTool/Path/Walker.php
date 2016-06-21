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
        $this->ptr =& $this->root;
    }


    public function traverse($path)
    {
        while ($elementName = array_shift($path)) {
            $position[]= $elementName;

            if (is_object($this->ptr)) {
                if (isset($this->ptr->$elementName)) {
                    $this->ptr =& $this->ptr->$elementName;
                } else {
                    throw new UndefinedPropertyException($elementName, $position);
                }
            } elseif (is_array($this->ptr)) {
                if (isset($this->ptr[$elementName])) {
                    $this->ptr =& $this->ptr[$elementName];
                } else {
                    throw new UndefinedKeyException($elementName, $position);
                }
            } elseif (is_scalar($this->ptr)) {
                throw new ValueHasNoPropertiesException($elementName, $position);
            }
        }

        return $this->ptr;
    }
}