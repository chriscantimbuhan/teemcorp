<?php

namespace App\FinancialModel;

use Illuminate\Support\Facades\Cache;

class FinancialModelManager
{
    /**
     * Get API key
     *
     * @return string
     */
    public function getApiKey()
    {
        return config('financial.api_key');
    }

    /**
     * Get API url
     *
     * @return string
     */
    public function getApiUrl()
    {
        return config('financial.api_url');
    }

    /**
     * Get API Attribute
     *
     * @return string
     */
    public function getApiAttribute()
    {
        return config('financial.attribute');
    }

    /**
     * Cached result
     *
     * @return array
     */
    protected function cacheResult($type, $data)
    {
        $currentCache = Cache::get($type) ?? collect();

        $currentCache->push($data);

        Cache::put($type, $currentCache);
    }

    /**
     * Filter cached data based on search
     *
     * @return string
     */
    protected function filterCachedData($cachedData, $key, $search)
    {
        if ($cachedData && $cachedData->isNotEmpty()) {
            $record = $cachedData->where($key, $search)->first();

            if ($record) {
                return $record;
            }
        }
    }
}
