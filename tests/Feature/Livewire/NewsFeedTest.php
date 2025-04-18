<?php

namespace Tests\Feature\Livewire;

use App\Livewire\NewsFeed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class NewsFeedTest extends TestCase
{
    public function test_it_loads_article_on_init(){
        Http::fake([
            'newsapi.org/v2/everything*' => Http::response([
                'articles' => [
                    ['title' => 'Test Article 1', 'description' => 'Description 1'],
                    ['title' => 'Test Article 2', 'description' => 'Description 2'],
                ]
            ])
                ]); 
        Livewire::test(NewsFeed::class)
        ->assertSet('articles',function($articles){
            return count($articles) === 2 && $articles[0]->title === 'Test Article 1';
        });
    }
    public function test_it_opens_fullscreen(){
        Http::fake([
            'newsapi.org/v2/everything*' => Http::response([
                'articles' => [
                    ['title' => 'Test Article 1', 'description' => 'Description 1', 'urlToImage' => 'testUrlImage1', 'url' => 'testUrl1'],
                    ['title' => 'Test Article 2', 'description' => 'Description 2', 'urlToImage' => 'testUrlImage2', 'url' => 'testUrl2'],
                ]
            ])
                ]); 
        Livewire::test(NewsFeed::class)
        ->call('openFullscreen',0)
        ->assertSet('fullscreen',true)
        ->assertSet('selectedArticle.title', 'Test Article 1');
    }

    public function test_it_handles_api_errors(){
        Http::fake([
            'newsapi.org/v2/everything*' => Http::response(
                ['message' => 'Invalid API key'], 
                401
            )
        ]);
    
        Livewire::test(NewsFeed::class)
            ->assertSet('error', 'Invalid API key')
            ->assertSet('articles', [])
            ->assertSee('Invalid API key');
    }
}
