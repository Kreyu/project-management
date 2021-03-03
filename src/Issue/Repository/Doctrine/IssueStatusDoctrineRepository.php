<?php

declare(strict_types=1);

namespace App\Issue\Repository\Doctrine;

use App\Issue\Collection\IssueStatusCollection;
use App\Issue\Model\IssueStatus;
use App\Issue\Repository\IssueStatusRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Repository\AbstractDoctrineRepository;
use Doctrine\ORM\NonUniqueResultException;

class IssueStatusDoctrineRepository extends AbstractDoctrineRepository implements IssueStatusRepositoryInterface
{
    protected function getEntityClass(): string
    {
        return IssueStatus::class;
    }

    /**
     * @param  int $issueStatusId
     *
     * @return IssueStatus
     * @throws ModelNotFoundException
     * @throws NonUniqueResultException
     */
    public function get(int $issueStatusId): IssueStatus
    {
        $issuePriority = $this->createQueryBuilder('issue_status')
            ->where('issue_status.id = :id')
            ->setParameter('id', $issueStatusId)
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $issuePriority) {
            throw new ModelNotFoundException(IssueStatus::class);
        }

        return $issuePriority;
    }

    public function all(): IssueStatusCollection
    {
        $issueStatuses = $this->createQueryBuilder('issue_status')
            ->getQuery()
            ->getResult();

        return new IssueStatusCollection($issueStatuses);
    }
}