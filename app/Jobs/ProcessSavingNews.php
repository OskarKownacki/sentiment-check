<?php

namespace App\Jobs;

use App\Models\News;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ProcessSavingNews implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected $data;
    protected $userId;
    /**
     * Create a new job instance.
     */
    public function __construct(Collection $data, $userId)
    {
        $this->userId = $userId;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(News $news): void
    {
        $news->saveNews($this->data, $this->userId);
    }

    public function failed(\Throwable $exception){
        dd($exception);
    }
}
