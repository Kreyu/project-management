<?php

declare(strict_types=1);

namespace App\Issue\Repository;

use App\Issue\Collection\IssuePriorityCollection;
use App\Issue\Model\IssuePriority;
use App\Shared\Exception\ModelNotFoundException;
use Symfony\Component\Uid\Uuid;

interface IssuePriorityRepositoryInterface
{
    /**
     * @param  Uuid $issuePriorityId
     *
     * @return IssuePriority
     *
     * @throws ModelNotFoundException
     */
    public function get(Uuid $issuePriorityId): IssuePriority;

    public function all(): IssuePriorityCollection;

    public function add(IssuePriority $issuePriority): void;

    public function getLatestPosition(): int;
}