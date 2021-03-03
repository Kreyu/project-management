<?php

declare(strict_types=1);

namespace App\Project\Repository;

use App\Project\Collection\ProjectCollection;
use App\Project\Model\Project;
use App\Shared\Exception\ModelNotFoundException;

interface ProjectRepositoryInterface
{
    /**
     * @param  int $projectId
     *
     * @return Project
     *
     * @throws ModelNotFoundException
     */
    public function get(int $projectId): Project;

    /**
     * @param  string $slug
     *
     * @return Project
     *
     * @throws ModelNotFoundException
     */
    public function getBySlug(string $slug): Project;

    public function all(): ProjectCollection;

    public function add(Project $project): void;

    public function update(Project $project): void;
}