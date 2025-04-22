<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.base')]
class NewsFeed extends Component
{
    public $articles = [];
    public $fullscreen = false;
    public $selectedArticle = null;
    public $error = null;
    #[Validate('string')]
    public $search;
    public $searchSanitized;

    public function boot()
    {

    }

    public function fetchArticles()
    {
        $this->validate();
        $this->searchSanitized = str_replace(' ', '+', $this->search);
        $apikey = $_ENV["NEWSAPI_KEY"];
        $response = Http::get('https://newsapi.org/v2/everything?q=' . $this->searchSanitized . '&language=en&apiKey=' . $apikey);
        try {
            if ($response->successful()) {
                $this->articles = $response->object()->articles;
            } else {
                $this->handleApiError($response->status());
            }
        } catch (\Exception $e) {
            $this->handleApiError($e->getMessage());
        }
    }
    public function openFullscreen($index)
    {
        $this->selectedArticle = $this->articles[$index];
        $this->fullscreen = true;
    }
    public function closeFullscreen()
    {
        $this->selectedArticle = null;
        $this->fullscreen = false;
    }
    public function render()
    {
        return view('livewire.news-feed');
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
