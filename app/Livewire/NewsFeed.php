<?php

namespace App\Livewire;

use App\Jobs\ProcessSavingNews;
use App\Jobs\ProcessUnsavingNews;
use App\Models\News;
use Auth;
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
    public $saved = [];
    public $articlesTop = [];



    public function mount(NewsService $newsService)
    {
        $this->articlesTop = $newsService->fetchTopNews();
    }


    public function fetchArticles(NewsService $newsService)
    {
        $this->saved = [];
        $this->validate();
        $this->searchSanitized = str_replace(' ', '+', $this->search);
        $this->articles = $newsService->fetchNews($this->searchSanitized);
        $posts = News::where('user_id', '=', Auth::id())->get()->toArray();
        foreach($this->articles as $index => $article){
            foreach($posts as $post){
                if($article->title == $post["title"]){
                    $this->saved[] = $index;
                }
            }
        }

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
    public function saveNews($id){
        $news = new News;
        if(!in_array($id, $this->saved)){
        $newsCollection = collect($this->articles[$id]);
        ProcessSavingNews::dispatch($newsCollection, Auth::id());
        $this->saved[] = $id;
        }
        else{
            ProcessUnsavingNews::dispatch($this->articles[$id]->title, Auth::id());
            $this->saved = array_diff($this->saved, [$id]);
        }
    }
    public function render()
    {
        return view('livewire.news-feed');
    }
}
