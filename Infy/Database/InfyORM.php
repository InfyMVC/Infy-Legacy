<?php
namespace Infy\Database;

abstract class InfyORM implements \ArrayAccess
{
    /**
     * Needed function for ArrayAccess
     * @param  integer $offset
     * @return bool
     */
    public function offsetExists ($offset)
    {
        return isset($this->{$offset});
    }

    /**
     * Needed function for ArrayAccess
     * @param  integer $offset
     * @return void
     */
    public function offsetUnset ($offset) {}

    /**
     * Needed function for ArrayAccess
     * @param  integer $offset
     * @return bool
     */
    public function offsetGet ($offset)
    {
        return $this->{$offset};
    }

    /**
     * Needed function for ArrayAccess
     * @param  integer $offset
     * @param  mixed $value
     * @return void
     */
    public function offsetSet ($offset, $value)
    {
        $this->{$offset} = $value;
    }

    /**
     * Saves the row in the database
     * @param bool $forceNewRow
     * @return void
     */
    public function save($forceNewRow = false)
    {

    }
}
