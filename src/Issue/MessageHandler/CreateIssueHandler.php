<?php

declare(strict_types=1);

namespace App\Issue\MessageHandler;

use App\Issue\Model\Issue;
use App\Issue\Message\CreateIssue;
use App\Issue\Repository\IssuePriorityRepositoryInterface;
use App\Issue\Repository\IssueRepositoryInterface;
use App\Issue\Repository\IssueStatusRepositoryInterface;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateIssueHandler implements MessageHandlerInterface
{
    private IssueRepositoryInterface $issueRepository;
    private ProjectRepositoryInterface $projectRepository;
    private IssueStatusRepositoryInterface $issueStatusRepository;
    private IssuePriorityRepositoryInterface $issuePriorityRepository;

    public function __construct(
        IssueRepositoryInterface $issueRepository,
        ProjectRepositoryInterface $projectRepository,
        IssueStatusRepositoryInterface $issueStatusRepository,
        IssuePriorityRepositoryInterface $issuePriorityRepository,
    ) {
        $this->issueRepository = $issueRepository;
        $this->projectRepository = $projectRepository;
        $this->issueStatusRepository = $issueStatusRepository;
        $this->issuePriorityRepository = $issuePriorityRepository;
    }

    /**
     * @param  CreateIssue $command
     *
     * @throws ModelNotFoundException
     */
    public function __invoke(CreateIssue $command): void
    {
        $project = $this->projectRepository->get($command->getProjectId());
        $priority = $this->issuePriorityRepository->get($command->getPriorityId());
        $status = $this->issueStatusRepository->get($command->getStatusId());

        $issue = new Issue(
            project: $project,
            subject: $command->getSubject(),
            description: $command->getDescription(),
            priority: $priority,
            status: $status,
        );

        $this->issueRepository->add($issue);
    }
}