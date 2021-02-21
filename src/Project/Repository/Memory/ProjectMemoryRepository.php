<?php

declare(strict_types=1);

namespace App\Project\Repository\Memory;

use App\Project\Model\Project;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use Symfony\Component\Uid\Uuid;

class ProjectMemoryRepository implements ProjectRepositoryInterface
{
    /**
     * @var Project[]
     */
    private array $projects;

    public function __construct()
    {
        $this->projects = [
            new Project('Project 1', 'Project 1 description', 'project-1'),
            new Project('Project 2', 'Project 2 description', 'project-2'),
            new Project('Project 3', 'Project 3 description', 'project-3'),
        ];
    }

    public function get(Uuid $id): Project
    {
        return $this->projects[$this->getKey($id)];
    }

    /**
     * @param  string $slug
     *
     * @return Project
     * @throws ModelNotFoundException
     */
    public function getBySlug(string $slug): Project
    {
        foreach ($this->projects as $project) {
            if ($project->getSlug() === $slug) {
                return $project;
            }
        }

        throw new ModelNotFoundException();
    }

    public function all(): array
    {
        return $this->projects;
    }

    public function add(Project $project): void
    {
        $this->projects[] = $project;
    }

    public function remove(Uuid $id): void
    {
        unset($this->projects[$this->getKey($id)]);
    }

    /**
     * @param  Project $project
     *
     * @throws ModelNotFoundException
     */
    public function update(Project $project): void
    {
        $this->projects[$this->getKey($project->getId())] = $project;

    }

    /**
     * @param  Uuid $id
     *
     * @return int
     * @throws ModelNotFoundException
     */
    private function getKey(Uuid $id): int
    {
        $key = array_search(static fn (Project $project) => $project->getId() === $id, $this->projects);

        if (!is_integer($key) || array_key_exists($key, $this->projects)) {
            throw new ModelNotFoundException();
        }

        return $key;
    }
}