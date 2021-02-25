<?php

declare(strict_types=1);

namespace App\Issue\MessageHandler;

use App\Issue\Model\Issue;
use App\Issue\Message\CreateIssue;
use App\Issue\Repository\IssueRepositoryInterface;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateIssueHandler implements MessageHandlerInterface
{
    private IssueRepositoryInterface $issueRepository;
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(
        IssueRepositoryInterface $issueRepository,
        ProjectRepositoryInterface $projectRepository,
    ) {
        $this->issueRepository = $issueRepository;
        $this->projectRepository = $projectRepository;
    }

    /**
     * @param  CreateIssue $command
     *
     * @throws ModelNotFoundException
     */
    public function __invoke(CreateIssue $command): void
    {
        $project = $this->projectRepository->get($command->getProjectId());

        $issue = new Issue(
            project: $project,
            subject: $command->getSubject(),
            description: $command->getDescription(),
        );

        $this->issueRepository->add($issue);
    }
}