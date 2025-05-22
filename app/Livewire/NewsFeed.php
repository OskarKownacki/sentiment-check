<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Services\NewsService;

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


    public function mount()
    {
   
    }

    public function fetchArticles(NewsService $newsService)
    {
        $this->validate();
        $this->searchSanitized = str_replace(' ', '+', $this->search);
        $this->articles = $newsService->fetchNews($this->searchSanitized);
        $this->error = $newsService->error;
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
}
