<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessUnsavingNews implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected $title;
    protected $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($title, $userId)
    {
        $this->title = $title;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(Post $post): void
    {
        $post->unsavePost($this->title, $this->userId);
    }
}
