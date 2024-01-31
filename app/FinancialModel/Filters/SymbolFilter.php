<?php

namespace App\FinancialModel\Filters;

use App\Support\APIFilter\FilterInterface;
use App\Support\APIFilter\FilterTrait;

class SymbolFilter implements FilterInterface
{
    use FilterTrait;

    const FILTER_LABEL = 'Symbol';

    const FILTER_VALUE = 'symbol';
}
