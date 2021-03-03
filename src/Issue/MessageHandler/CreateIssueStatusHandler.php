<?php

declare(strict_types=1);

namespace App\Issue\MessageHandler;

use App\Issue\Message\CreateIssueStatus;
use App\Issue\Model\IssueStatus;
use App\Issue\Repository\IssueStatusRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateIssueStatusHandler implements MessageHandlerInterface
{
    private IssueStatusRepositoryInterface $issueStatusRepository;

    public function __construct(IssueStatusRepositoryInterface $issueStatusRepository)
    {
        $this->issueStatusRepository = $issueStatusRepository;
    }

    public function __invoke(CreateIssueStatus $command): void
    {
        $issuePriority = new IssueStatus(
            name: $command->getName(),
            description: $command->getDescription(),
            colorHex: $command->getColorHex(),
        );

        $this->issueStatusRepository->add($issuePriority);
    }
}