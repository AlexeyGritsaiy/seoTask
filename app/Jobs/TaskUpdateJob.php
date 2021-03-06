<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Task;
use App\Services\DataForSeoHttpClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TaskUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Task
     */
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function handle(DataForSeoHttpClient $client): void
    {
        $result = $client->getTask($this->task->task_id);
    }
}
