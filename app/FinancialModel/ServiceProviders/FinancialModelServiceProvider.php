<?php

namespace App\FinancialModel\ServiceProviders;

use App\FinancialModel\Factories\FinancialTypeFactory;
use App\Support\APIFilter\FilterFactory;
use Illuminate\Support\ServiceProvider;

class FinancialModelServiceProvider extends ServiceProvider 
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() 
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('financial.filters', function ($app) {
            return new FilterFactory($app, $app['config']->get('financial.filters'));
        });

        $this->app->singleton('financial.search_types', function ($app) {
            return $this->arrayToDropdowns($app['config']->get('financial.search_types'));
        });

        $this->app->singleton('financial.filter_types', function ($app) {
            return new FinancialTypeFactory($app, $app['config']->get('financial.filter_types'));
        });
    }

    /**
     * Format array to dropdowns
     *
     * @param array $array
     * @return array
     */
    public function arrayToDropdowns($array)
    {
        $data[] = [
            'value' => '',
            'label' => 'Select One'
        ];

        foreach ($array as $key => $val) {
            array_push($data, [
                'value' => $key,
                'label' => $val
            ]);
        }

        return $data;
    }
}