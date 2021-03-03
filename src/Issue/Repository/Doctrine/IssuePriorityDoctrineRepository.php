<?php

declare(strict_types=1);

namespace App\Issue\Repository\Doctrine;

use App\Issue\Collection\IssuePriorityCollection;
use App\Issue\Model\IssuePriority;
use App\Issue\Repository\IssuePriorityRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Repository\AbstractDoctrineRepository;
use Doctrine\ORM\NonUniqueResultException;

class IssuePriorityDoctrineRepository extends AbstractDoctrineRepository implements IssuePriorityRepositoryInterface
{
    protected function getEntityClass(): string
    {
        return IssuePriority::class;
    }

    /**
     * @param  int $issuePriorityId
     *
     * @return IssuePriority
     * @throws ModelNotFoundException
     * @throws NonUniqueResultException
     */
    public function get(int $issuePriorityId): IssuePriority
    {
        $issuePriority = $this->createQueryBuilder('issue_priority')
            ->where('issue_priority.id = :id')
            ->setParameter('id', $issuePriorityId)
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
}