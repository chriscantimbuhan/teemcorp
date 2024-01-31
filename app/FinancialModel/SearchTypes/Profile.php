<?php

namespace App\FinancialModel\SearchTypes;

use App\FinancialModel\FinancialModelInterface;
use App\FinancialModel\FinancialModelManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Profile extends FinancialModelManager implements FinancialModelInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Set search type
     *
     * @return string
     */
    public function searchType()
    {
        return 'profile';
    }

    /**
     * Set API url
     *
     * @return string
     */
    public function apiUrl()
    {
        return $this->searchType() . '/' . $this->value();
    }

    /**
     * Set search key
     *
     * @return string
     */
    public function key()
    {
        return 'symbol';
    }

    /**
     * Set search value
     *
     * @return string
     */
    public function value()
    {
        return $this->request->input('symbol');
    }

    /**
     * Execute process
     *
     * @return array|object
     */
    public function execute()
    {
        $cachedData = Cache::get($this->searchType());

        $fromCache = $this->filterCachedData($cachedData, $this->key(), $this->value());

        if (! $fromCache) {
            try {
                $response = Http::get($this->getApiUrl() . $this->apiUrl(), [
                        $this->getApiAttribute() => $this->getApiKey()
                    ]);
            
                if ($response->successful()) {
                    $data = $response->json();
    
                    if (count($data)) {
                        $this->cacheResult($this->searchType(), $data[0]);
    
                        return $data[0];
                    }

                    return null;
                } else {
                    $statusCode = $response->status();
                    $errorMessage = $response->body();
    
                    throw new \Exception("API request failed with status code: $statusCode, Message: $errorMessage");
                }
            } catch (\Exception $exception) {
                return ['error' => $exception->getMessage()];
            }
        }

        return $fromCache;
    }
}