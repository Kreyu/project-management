<?php

declare(strict_types=1);

namespace App\Issue\Repository\Doctrine;

use App\Issue\Collection\IssueCollection;
use App\Issue\Collection\IssuePriorityCollection;
use App\Issue\Model\Issue;
use App\Issue\Model\IssuePriority;
use App\Issue\Repository\IssuePriorityRepositoryInterface;
use App\Issue\Repository\IssueRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Repository\AbstractDoctrineRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Uid\Uuid;

class IssuePriorityDoctrineRepository extends AbstractDoctrineRepository implements IssuePriorityRepositoryInterface
{
    protected function getEntityClass(): string
    {
        return IssuePriority::class;
    }

    /**
     * @param  Uuid $issuePriorityId
     *
     * @return IssuePriority
     * @throws ModelNotFoundException
     * @throws NonUniqueResultException
     */
    public function get(Uuid $issuePriorityId): IssuePriority
    {
        $issuePriority = $this->createQueryBuilder('issue_priority')
            ->where('issue_priority.id = :id')
            ->setParameter('id', $issuePriorityId->toBinary())
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $issuePriority) {
            throw new ModelNotFoundException(IssuePriority::class);
        }

        return $issuePriority;
    }

    public function all(): IssuePriorityCollection
    {
        $issuePriorities = $this->createQueryBuilder('issue_priority')
            ->orderBy('issue_priority.position', 'ASC')
            ->getQuery()
            ->getResult();

        return new IssuePriorityCollection($issuePriorities);
    }

    public function add(IssuePriority $issuePriority): void
    {
        $this->entityManager->persist($issuePriority);
        $this->entityManager->flush();
    }

    public function getLatestPosition(): int
    {
        try {
            return (int) $this->createQueryBuilder('issue_priority')
                ->select('MAX(issue_priority.position)')
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException) {
            return 0;
        }
    }
}