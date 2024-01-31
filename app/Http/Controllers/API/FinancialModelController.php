<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancialModelController extends Controller
{
    public function search(Request $request)
    {
        $class = app('financial.filter_types')->make(
            $request->input('search_type')
        );

        return $class ? (new $class($request))->execute() : null;
    }

    /**
     * List available filter options
     *
     * @return \Illuminate\Support\Collection
     */
    public function options()
    {
        return app('financial.filters')->list();
    }

    /**
     * List available filter options
     *
     * @return \Illuminate\Support\Collection
     */
    public function searchTypes()
    {
        return app('financial.search_types');
    }
}
