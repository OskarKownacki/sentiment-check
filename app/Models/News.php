<?php

namespace App\Models;

use Auth;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
        protected $fillable = [
        'title',
        'link_to_image',
        'link_to_article',
        'content'
    ];

    public function saveNews(Collection $newsCollection, $userId){
        $news = new News;
        $news->title = $newsCollection["title"];
        $news->link_to_image = $newsCollection["urlToImage"];
        $news->link_to_article = $newsCollection["url"];
        $news->content = $newsCollection["content"];
        $news->user_id = $userId;
        $news->save();
    }

    public function unsaveNews($title, $userId){
        News::where('user_id', '=', $userId)->where('title','=',$title)->delete();

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
