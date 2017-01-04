<?php
/**
 * @author Gerard van Helden <gerard@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\ConfigTool\Loader;

/**
 * Base interface for all loaders
 */
interface LoaderInterface
{
    /**
     * Sets the stream where to load the input from.
     *
     * @param resource $stream
     * @return void
     */
    public function setInput($stream);

    /**
     * Loads the resource's content from the specified input stream
     *
     * @return mixed
     */
    public function load();
}
