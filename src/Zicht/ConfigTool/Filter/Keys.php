<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Filter;

/**
 * Merge keys/values
 */
class Keys implements FilterInterface
{
    /**
     * @{inheritDoc}
     */
    public function filter($value)
    {
        $ret = [];
        foreach ($value as $key => $v) {
            $ret[]= [$key, $v];
        }
        return $ret;
    }
}