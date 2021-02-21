<?php

declare(strict_types=1);

namespace App\Issue\Repository;

use App\Issue\Model\Issue;
use Symfony\Component\Uid\Uuid;

interface IssueRepositoryInterface
{
    /**
     * @param  Uuid $projectId
     *
     * @return Issue[]
     */
    public function getByProjectId(Uuid $projectId): array;
}