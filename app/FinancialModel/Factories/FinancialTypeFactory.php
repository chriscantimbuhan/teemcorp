<?php

namespace App\FinancialModel\Factories;

class FinancialTypeFactory
{
    /**
     * @var \Illuminate\Support\Collection
     */
    protected $searchType;

    public function __construct($app, array $searchType)
    {
        $this->searchType = collect($searchType);
    }

    /**
     * Get needed class for specific type
     */
    public function make($field)
    {
        if (! $this->exists($field)) {
            return;
        }

        return $this->searchType->get($field);
    }

    /**
     * Determine if there is an action with the given field.
     * 
     * @param string $field
     * @return bool
     */
    public function exists($field)
    {
        return $this->searchType->has($field);
    }
}