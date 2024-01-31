<?php

namespace App\FinancialModel\SearchTypes;

use App\FinancialModel\FinancialModelInterface;
use Illuminate\Http\Request;

class Quote extends Profile
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Set Search type
     */
    public function searchType()
    {
        return 'quote';
    }
}
