<?php

declare(strict_types=1);

namespace App\Project\Repository;

use App\Project\Model\Project;
use App\Shared\Exception\ModelNotFoundException;
use Symfony\Component\Uid\Uuid;

interface ProjectRepositoryInterface
{
    /**
     * @param  Uuid $id
     *
     * @return Project
     *
     * @throws ModelNotFoundException
     */
    public function get(Uuid $id): Project;

    /**
     * @param  string $slug
     *
     * @return Project
     *
     * @throws ModelNotFoundException
     */
    public function getBySlug(string $slug): Project;

    public function add(Project $project): void;

    /**
     * @param  Project $project
     *
     * @throws ModelNotFoundException
     */
    public function remove(Project $project): void;

    public function update(Project $project): void;
}