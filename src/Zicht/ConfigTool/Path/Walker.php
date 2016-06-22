<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Path;

/**
 * Class Walker
 *
 * Traverses through an object graph using the specified path.
 */
class Walker
{
    /**
     * Constructor
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->root = $value;
    }


    /**
     * Find the value at the given path
     *
     * @param string[] $path
     * @return mixed
     */
    public function traverse($path)
    {
        $ret = $this->root;
        $position = [];
        while (null !== ($elementName = array_shift($path))) {
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
            $position[]= $elementName;
        }

        return $ret;
    }
}