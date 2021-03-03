<?php

declare(strict_types=1);

namespace App\Project\Repository\Doctrine;

use App\Project\Collection\ProjectCollection;
use App\Project\Model\Project;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Repository\AbstractDoctrineRepository;
use Doctrine\ORM\NonUniqueResultException;

class ProjectDoctrineRepository extends AbstractDoctrineRepository implements ProjectRepositoryInterface
{
    protected function getEntityClass(): string
    {
        return Project::class;
    }

    /**
     * @param  int $projectId
     *
     * @return Project
     * @throws ModelNotFoundException
     * @throws NonUniqueResultException
     */
    public function get(int $projectId): Project
    {
        $project = $this->createQueryBuilder('project')
            ->where('project.id = :id')
            ->setParameter('id', $projectId)
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $project) {
            throw new ModelNotFoundException(Project::class);
        }

        return $project;
    }

    /**
     * @param  string $slug
     *
     * @return Project
     * @throws ModelNotFoundException
     * @throws NonUniqueResultException
     */
    public function getBySlug(string $slug): Project
    {
        $project = $this->createQueryBuilder('project')
            ->where('project.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $project) {
            throw new ModelNotFoundException(Project::class);
        }

        return $project;
    }

    public function all(): ProjectCollection
    {
        $projects = $this->createQueryBuilder('project')
            ->getQuery()
            ->getResult();

        return new ProjectCollection($projects);
    }
}