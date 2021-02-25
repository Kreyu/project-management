<?php

declare(strict_types=1);

namespace App\Task\MessageHandler;

use App\Issue\Repository\IssueRepositoryInterface;
use App\Task\Model\Task;
use App\Task\Message\CreateTask;
use App\Task\Repository\TaskRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateTaskHandler implements MessageHandlerInterface
{
    private TaskRepositoryInterface $taskRepository;
    private IssueRepositoryInterface $issueRepository;

    public function __construct(TaskRepositoryInterface $taskRepository, IssueRepositoryInterface $issueRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->issueRepository = $issueRepository;
    }

    /**
     * @param  CreateTask $command
     *
     * @throws ModelNotFoundException
     */
    public function __invoke(CreateTask $command): void
    {
        $issue = $this->issueRepository->get($command->getIssueId());

        $task = new Task(
            issue: $issue,
            subject: $command->getSubject(),
            description: $command->getDescription(),
        );

        $this->taskRepository->add($task);
    }
}