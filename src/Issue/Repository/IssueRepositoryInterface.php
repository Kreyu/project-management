<?php

declare(strict_types=1);

namespace App\Issue\Repository;

use App\Issue\Collection\IssueCollection;
use App\Issue\Model\Issue;
use App\Shared\Exception\ModelNotFoundException;
use Symfony\Component\Uid\Uuid;

interface IssueRepositoryInterface
{
    /**
     * @param  Uuid $issueId
     *
     * @return Issue
     *
     * @throws ModelNotFoundException
     */
    public function get(Uuid $issueId): Issue;

    public function getByProjectId(Uuid $projectId): IssueCollection;

    public function all(): IssueCollection;

    public function add(Issue $issue): void;
}