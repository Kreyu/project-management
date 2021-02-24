<?php

declare(strict_types=1);

namespace App\Issue\Repository\Memory;

use App\Issue\Model\Issue;
use App\Issue\Repository\IssueRepositoryInterface;
use App\Project\Model\Project;
use App\Project\Repository\ProjectRepositoryInterface;
use Symfony\Component\Uid\Uuid;

class IssueMemoryRepository implements IssueRepositoryInterface
{
    /**
     * @var Issue[]
     */
    private array $issues = [];

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
    }

    public function getByProjectId(Uuid $projectId): array
    {
        return array_values(array_filter($this->issues, function (Issue $issue) use ($projectId) {
            return $issue->getProject()->getId()->equals($projectId);
        }));
    }
}