<?php

namespace Tests\Feature\Livewire;

use App\Livewire\NewsFeed;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class NewsFeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_successfully()
    {
        Livewire::test(NewsFeed::class)
            ->assertStatus(200);
    }

    public function test_it_opens_fullscreen()
    {
        Http::fake([
            'newsapi.org/v2/everything*' => Http::response([
                'articles' => [
                    ['title' => 'Test Article 1', 'description' => 'Description 1', 'urlToImage' => 'testUrlImage1', 'url' => 'testUrl1'],
                    ['title' => 'Test Article 2', 'description' => 'Description 2', 'urlToImage' => 'testUrlImage2', 'url' => 'testUrl2'],
                ]
            ])
        ]);


        Livewire::actingAs(User::factory()->create())
            ->test(NewsFeed::class)
            ->set('search', 'Test value')
            ->call('fetchArticles')
            ->call('openFullscreen', 0)
            ->assertSet('fullscreen', true)
            ->assertSet('selectedArticle.title', 'Test Article 1');
    }

    public function test_it_handles_api_errors()
    {
        Http::fake([
            'newsapi.org/v2/everything*' => Http::response(
                ['message' => 'Invalid API key'],
                401
            )
        ]);

        Livewire::actingAs(User::factory()->create())
            ->test(NewsFeed::class)
            ->set('search', 'Test value')
            ->call('fetchArticles')
            ->assertSet('error', 'Invalid API key')
            ->assertSet('articles', [])
            ->assertSee('Invalid API key');
    }

    public function test_it_sanitizes_input()
    {
        Livewire::actingAs(User::factory()->create())
            ->test(NewsFeed::class)
            ->set('search', 'Test value')
            ->call('fetchArticles')
            ->assertSet('searchSanitized', 'Test+value');
    }

    public function test_it_clears_saved_array(){
        Livewire::actingAs(User::factory()->create())
            ->test(NewsFeed::class)
            ->set('search', 'Test value')
            ->call('fetchArticles')
            ->assertSet('saved',[]);
    }

    public function test_it_saves_properly(){
         Http::fake([
            'newsapi.org/v2/everything*' => Http::response([
                'articles' => [
                    ['title' => 'Test Article 1', 'description' => 'Description 1', 'urlToImage' => 'testUrlImage1', 'url' => 'testUrl1', 'content' => 'testContent1'],
                    ['title' => 'Test Article 2', 'description' => 'Description 2', 'urlToImage' => 'testUrlImage2', 'url' => 'testUrl2', 'content' => 'testContent2'],
                ]
            ])
        ]);
        
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::actingAs($user)
            ->test(NewsFeed::class)
            ->set('search', 'Test value')
            ->call('fetchArticles')
            ->call('savePost',0);

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Article 1',
            'link_to_image' => 'testUrlImage1',
            'content' => 'testContent1',
            'link_to_article' => 'testUrl1',
            'user_id' => $user->id
        ]);
    }
    public function test_it_removes_index_from_saved_array(){

        Http::fake([
            'newsapi.org/v2/everything*' => Http::response([
                'articles' => [
                    ['title' => 'Test Article 1', 'description' => 'Description 1', 'urlToImage' => 'testUrlImage1', 'url' => 'testUrl1', 'content' => 'testContent1'],
                    ['title' => 'Test Article 2', 'description' => 'Description 2', 'urlToImage' => 'testUrlImage2', 'url' => 'testUrl2', 'content' => 'testContent2'],
                ]
            ])
        ]);
        Livewire::actingAs(User::factory()->create())
            ->test(NewsFeed::class)
            ->set('search', 'Test value')
            ->call('fetchArticles')
            ->call('savePost',0)
            ->assertSet('saved',[0]);
    }


}
