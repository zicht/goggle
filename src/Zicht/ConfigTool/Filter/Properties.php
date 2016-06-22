<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Filter;


/**
 * Whitelisted property filter: creates a dictionary containing key/value pairs for all object properties that are
 * in the whitelist.
 */
class Properties implements FilterInterface
{
    /**
     * Construct the filter
     *
     * @param string[] $properties
     */
    public function __construct($properties)
    {
        $this->properties = $properties;
    }


    /**
     * @{inheritDoc}
     */
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