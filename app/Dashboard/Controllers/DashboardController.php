<?php

namespace App\Dashboard\Controllers;

use App\Http\Controllers\API\FinancialModelController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a dashboard view
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return inertia('Dashboard/Index', [
            'options' => (new FinancialModelController)->options(),
            'search_types' => (new FinancialModelController)->searchTypes()
        ]);
    }
}
