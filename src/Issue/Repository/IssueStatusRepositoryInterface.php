<?php

declare(strict_types=1);

namespace App\Issue\Repository;

use App\Issue\Collection\IssueCollection;
use App\Issue\Collection\IssueStatusCollection;
use App\Issue\Model\Issue;
use App\Issue\Model\IssueStatus;
use App\Shared\Exception\ModelNotFoundException;
use Symfony\Component\Uid\Uuid;

interface IssueStatusRepositoryInterface
{
    /**
     * @param  int $issueStatusId
     *
     * @return IssueStatus
     *
     * @throws ModelNotFoundException
     */
    public function get(int $issueStatusId): IssueStatus;

    public function all(): IssueStatusCollection;

    public function add(IssueStatus $issueStatus): void;
}