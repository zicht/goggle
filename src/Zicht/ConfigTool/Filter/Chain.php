<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Filter;

class Chain implements FilterInterface
{
    /**
     * @var FilterInterface[]
     */
    protected $filters = [];

    /**
     * Filter the specified value through all child filters.
     *
     * @param mixed $value
     * @return array|mixed
     */
    public function filter($value)
    {
        foreach ($this->filters as $filter) {
            $value = $filter->filter($value);
        }

        return $value;
    }

    /**
     * Add a filter. Provides fluent interface
     *
     * @param FilterInterface $filter
     * @return self
     */
    public function add(FilterInterface $filter)
    {
        $this->filters[]= $filter;
        return $this;
    }
}
