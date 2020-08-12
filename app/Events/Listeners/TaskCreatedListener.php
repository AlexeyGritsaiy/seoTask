<?php

declare(strict_types=1);

namespace App\Events\Listeners;

use App\Events\TaskCreatedEvent;
use App\Jobs\TaskUpdateJob;

class TaskCreatedListener
{
    public function handle(TaskCreatedEvent $event)
    {
        TaskUpdateJob::dispatch($event->getTask());
    }
}
