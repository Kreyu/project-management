<?php

declare(strict_types=1);

namespace App\Task\Repository;

use App\Task\Collection\TaskCollection;
use App\Task\Model\Task;
use Symfony\Component\Uid\Uuid;

interface TaskRepositoryInterface
{
    public function getByProjectId(Uuid $projectId): TaskCollection;

    public function getByIssueId(Uuid $issueId): TaskCollection;

    public function add(Task $task): void;
}