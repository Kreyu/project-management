<?php

declare(strict_types=1);

namespace App\Issue\Repository\Doctrine;

use App\Issue\Collection\IssueCollection;
use App\Issue\Model\Issue;
use App\Issue\Repository\IssueRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Repository\AbstractDoctrineRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Uid\Uuid;

class IssueDoctrineRepository extends AbstractDoctrineRepository implements IssueRepositoryInterface
{
    public static function getEntityClass(): string
    {
        return Issue::class;
    }

    /**
     * @param  Uuid $issueId
     *
     * @return Issue
     * @throws ModelNotFoundException
     * @throws NonUniqueResultException
     */
    public function get(Uuid $issueId): Issue
    {
        $project = $this->repository->createQueryBuilder('issue')
            ->where('issue.id = :id')
            ->setParameter('id', $issueId->toBinary())
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $project) {
            throw new ModelNotFoundException(Issue::class);
        }

        return $project;
    }

    public function getByProjectId(Uuid $projectId): IssueCollection
    {
        $issues = $this->repository->createQueryBuilder('issue')
            ->where('issue.project = :project')
            ->setParameter('project', $projectId->toBinary())
            ->getQuery()
            ->getResult();

        return new IssueCollection($issues);
    }

    public function all(): IssueCollection
    {
        $issues = $this->repository->createQueryBuilder('issue')
            ->getQuery()
            ->getResult();

        return new IssueCollection($issues);
    }

    public function add(Issue $issue): void
    {
        $this->entityManager->persist($issue);
        $this->entityManager->flush();
    }
}