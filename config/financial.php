<?php

return [
    'api_key' => env('FINANCIAL_MODEL_API_KEY'),
    'api_url' => env('FINANCIAL_MODEL_URL'),
    'attribute' => env('FINANCIAL_MODEL_API_ATTRIBUTE'),

    'filters' => [
        App\FinancialModel\Filters\SymbolFilter::class
    ],

    'search_types' => [
        'profile' => 'Profile',
        'quote' => 'Quote'
    ],

    'filter_types' => [
        'profile' => App\FinancialModel\SearchTypes\Profile::class,
        'quote' => App\FinancialModel\SearchTypes\Quote::class
    ]
];
