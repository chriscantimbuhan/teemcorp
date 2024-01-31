<?php

namespace App\Support\APIFilter;

trait FilterTrait
{
    /**
     * Get avaialable label
     *
     * @return string
     */
    public function label()
    {
        return static::FILTER_LABEL;
    }

    /**
     * Get avaialable key
     *
     * @return string
     */
    public function key()
    {
        return static::FILTER_VALUE;
    }
}
