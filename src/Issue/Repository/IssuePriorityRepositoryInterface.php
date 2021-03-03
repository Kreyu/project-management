<?php

declare(strict_types=1);

namespace App\Issue\Repository;

use App\Issue\Collection\IssuePriorityCollection;
use App\Issue\Model\IssuePriority;
use App\Shared\Exception\ModelNotFoundException;

interface IssuePriorityRepositoryInterface
{
    /**
     * @param  int $issuePriorityId
     *
     * @return IssuePriority
     *
     * @throws ModelNotFoundException
     */
    public function get(int $issuePriorityId): IssuePriority;

    public function all(): IssuePriorityCollection;

    public function add(IssuePriority $issuePriority): void;
}