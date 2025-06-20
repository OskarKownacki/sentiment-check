<?php

namespace App\Jobs;

use App\Models\News;
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
    public function handle(News $news): void
    {
        $news->unsaveNews($this->title, $this->userId);
    }
}
