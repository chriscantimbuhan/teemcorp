<?php

namespace App\Support\APIFilter;

use Illuminate\Http\Request;

class FilterFactory
{
    protected $app;

    protected $filters;

    public function __construct($app, $filters)
    {
        $this->app = $app;
        $this->filters = collect($filters);
    }

    /**
     * List filters available
     *
     * @return \Illuminate\Support\Collection
     */
    public function list()
    {
        return $this->makeFiltersToArray();
    }

    /**
     * List filters available
     *
     * @return \Illuminate\Support\Collection
     */
    public function makeFiltersToArray()
    {
        $list = collect();

        $this->filters->each(function ($filter) use ($list) {
            $class = (new $filter);

            $defaults = [
                'label' => $class->label(),
                'key' => $class->key()
            ];

            $list->push($defaults);
        });

        return $list;
    }

    /**
     * Make query structure
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function makeQuery(Request $request)
    {
        $query = collect();

        $this->filters->each(function ($filter) use ($request) {
            $class = (new $filter);

            foreach ($request->all() as $key => $value) {
                if ($key == $class->key()) {
                    $query = $class->apply($request, $value);
                }
            }
        });

        return $query->push($query);
    }

    /**
     * Check if method exists in a class
     *
     * @param mixed $class
     * @param string $method
     * @return bool
     */
    protected function methodExists($class, $method)
    {
        return method_exists($class, $method);
    }
}
