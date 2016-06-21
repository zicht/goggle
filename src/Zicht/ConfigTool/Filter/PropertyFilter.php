<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Filter;


class PropertyFilter
{
    public function __construct($properties)
    {
        $this->properties = $properties;
    }


    public function filter($value)
    {
        if (is_scalar($value)) {
            return $value;
        }
        if (!$this->properties) {
            return $value;
        }
        $ret = [];
        foreach ($this->properties as $key) {
            $ret[$key] = is_object($value) ? $value->$key : $value[$key];
        }
        return $ret;
    }
}