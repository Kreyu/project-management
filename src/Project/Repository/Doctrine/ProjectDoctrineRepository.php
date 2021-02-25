<?php

declare(strict_types=1);

namespace App\Project\Repository\Doctrine;

use App\Project\Collection\ProjectCollection;
use App\Project\Model\Project;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Repository\AbstractDoctrineRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Uid\Uuid;

class ProjectDoctrineRepository extends AbstractDoctrineRepository implements ProjectRepositoryInterface
{
    public static function getEntityClass(): string
    {
        return Project::class;
    }

    /**
     * @param  Uuid $projectId
     *
     * @return Project
     * @throws ModelNotFoundException
     * @throws NonUniqueResultException
     */
    public function get(Uuid $projectId): Project
    {
        $project = $this->repository->createQueryBuilder('project')
            ->where('project.id = :id')
            ->setParameter('id', $projectId->toBinary())
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
        $project = $this->repository->createQueryBuilder('project')
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
        $projects = $this->repository->createQueryBuilder('project')
            ->getQuery()
            ->getResult();

        return new ProjectCollection($projects);
    }

    public function add(Project $project): void
    {
        $this->entityManager->persist($project);
        $this->entityManager->flush();
    }

    public function update(Project $project): void
    {
        $this->entityManager->flush();
    }
}