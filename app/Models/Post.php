<?php

namespace App\Models;

use Auth;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
        protected $fillable = [
        'title',
        'link_to_image',
        'link_to_article',
        'content'
    ];

    public function savePost(Collection $postCollection, $userId){
        $post = new Post;
        $post->title = $postCollection["title"];
        $post->link_to_image = $postCollection["urlToImage"];
        $post->link_to_article = $postCollection["url"];
        $post->content = $postCollection["content"];
        $post->user_id = $userId;
        $post->save();
    }

    public function unsavePost($title, $userId){
        Post::where('user_id', '=', $userId)->where('title','=',$title)->delete();

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
