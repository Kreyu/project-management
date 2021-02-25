<?php

declare(strict_types=1);

namespace App\Task\Form\Data;

use App\Task\Model\Task;

class TaskData
{
    public mixed $issue;
    public mixed $subject;
    public mixed $description;

    public static function createFromTask(Task $task): self
    {
        $data = new self;
        $data->issue = $task->getIssue();
        $data->subject = $task->getSubject();
        $data->description = $task->getDescription();

        return $data;
    }
}