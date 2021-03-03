<?php

declare(strict_types=1);

namespace App\Issue\Repository;

use App\Issue\Collection\IssueCollection;
use App\Issue\Model\Issue;
use App\Shared\Exception\ModelNotFoundException;

interface IssueRepositoryInterface
{
    /**
     * @param  int $issueId
     *
     * @return Issue
     *
     * @throws ModelNotFoundException
     */
    public function get(int $issueId): Issue;

    public function getByProjectId(int $projectId): IssueCollection;

    public function all(): IssueCollection;

    public function add(Issue $issue): void;
}