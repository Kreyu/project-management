<?php

declare(strict_types=1);

namespace App\Project\Repository\Doctrine;

use App\Project\Model\Project;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Pagination\DoctrinePaginator;
use App\Shared\Pagination\PaginatorInterface;
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
     * @param  Uuid $id
     *
     * @return Project
     * @throws ModelNotFoundException
     * @throws NonUniqueResultException
     */
    public function get(Uuid $id): Project
    {
        $project = $this->repository->createQueryBuilder('project')
            ->where('project.id = :id')
            ->setParameter('id', $id->toBinary())
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $project) {
            throw new ModelNotFoundException();
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
            throw new ModelNotFoundException();
        }

        return $project;
    }

    public function add(Project $project): void
    {
        $this->entityManager->persist($project);
        $this->entityManager->flush();
    }

    public function remove(Project $project): void
    {
        $this->entityManager->remove($project);
        $this->entityManager->flush();
    }

    public function update(Project $project): void
    {
        $this->entityManager->flush();
    }

    /**
     * @param  int $page
     * @param  int $perPage
     *
     * @return PaginatorInterface
     */
    public function paginate(int $page, int $perPage): PaginatorInterface
    {
        $queryBuilder = $this->repository->createQueryBuilder('project');

        return new DoctrinePaginator($queryBuilder, $page, $perPage);
    }
}