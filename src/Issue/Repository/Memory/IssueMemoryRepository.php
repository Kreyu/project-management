<?php

declare(strict_types=1);

namespace App\Issue\Repository\Memory;

use App\Issue\Model\Issue;
use App\Issue\Repository\IssueRepositoryInterface;
use App\Project\Repository\ProjectRepositoryInterface;
use Symfony\Component\Uid\Uuid;

class IssueMemoryRepository implements IssueRepositoryInterface
{
    /**
     * @var Issue[]
     */
    private array $issues;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $projects = $projectRepository->all();

        $this->issues = [
            new Issue($projects[0], 'Issue 1', 'Issue 1 description'),
            new Issue($projects[0], 'Issue 2', 'Issue 2 description'),
            new Issue($projects[0], 'Issue 3', 'Issue 3 description'),
            new Issue($projects[1], 'Issue 4', 'Issue 4 description'),
            new Issue($projects[1], 'Issue 5', 'Issue 5 description'),
            new Issue($projects[1], 'Issue 6', 'Issue 6 description'),
            new Issue($projects[2], 'Issue 7', 'Issue 7 description'),
            new Issue($projects[2], 'Issue 8', 'Issue 8 description'),
            new Issue($projects[2], 'Issue 9', 'Issue 9 description'),
        ];
    }

    public function getByProjectId(Uuid $projectId): array
    {
        return array_values(array_filter($this->issues, function (Issue $issue) use ($projectId) {
            return $issue->getProject()->getId()->equals($projectId);
        }));
    }
}