<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class NewsFeed extends Component
{
    public $articles = [];
    public $fullscreen = false;
    public $selectedArticle = null;

    public function boot(){
        $apikey = $_ENV["NEWSAPI_KEY"];
        $response = Http::get('https://newsapi.org/v2/everything?q=bitcoin&language=en&apiKey='.$apikey);
        $this->articles = $response->object()->articles;
    
    }

    public function openFullscreen($index){
        $this->selectedArticle = $this->articles[$index];
        $this->fullscreen = true;
    }
    public function closeFullscreen(){
        $this->selectedArticle = null;
        $this->fullscreen = false;
    }
    public function render()
    {
        return view('livewire.news-feed');
    }
}
