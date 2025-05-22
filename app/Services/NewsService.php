<?php

namespace App\Services;

use Http;


class NewsService
{
    protected $apiKey;
    protected $articles;
    public $error;

    public function __construct($api){
        $this->apiKey = $api;
    }

    public function fetchNews(string $query){
        $response = Http::get('https://newsapi.org/v2/everything?q=' . $query . '&language=en&apiKey=' . $this->apiKey);
        try {
            if ($response->successful()) {
                $this->articles = $response->object()->articles;
            } else {
                $this->handleApiError($response->status());
            }
        } catch (\Exception $e) {
            $this->handleApiError($e->getMessage());
            
        }
        return $this->articles;
    }
    protected function handleApiError($error)
    {
        $this->error = match (true) {
            $error === 401 => 'Invalid API key',
            $error === 429 => 'API rate limit exceeded',
            $error === 500 => 'Server error',
            is_string($error) => $error,
            default => 'Failed to load news feed'
        };
        $this->articles = [];
    }
}

?>