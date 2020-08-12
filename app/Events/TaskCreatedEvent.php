<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Task;

class TaskCreatedEvent
{
    /**
     * @var Task
     */
    private $task;

    public function __construct(Task  $task)
    {
        $this->task = $task;
    }

    /**
     * @return Task
     */
    public function getTask(): Task
    {
        return $this->task;
    }
}
