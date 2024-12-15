<?php

namespace App\Enums\Task;

enum TaskStatusEnum: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';
}
