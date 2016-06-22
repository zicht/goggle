<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */
namespace Zicht\ConfigTool\Filter;

/**
 * Interface FilterInterface
 */
interface FilterInterface
{
    /**
     * Returns a filtered version of the value
     *
     * @param mixed $value
     * @return array
     */
    public function filter($value);
}