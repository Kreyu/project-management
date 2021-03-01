<?php

declare(strict_types=1);

namespace App\Issue\Repository\Doctrine;

use App\Issue\Collection\IssueCollection;
use App\Issue\Collection\IssueStatusCollection;
use App\Issue\Model\IssueStatus;
use App\Issue\Repository\IssueStatusRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Repository\AbstractDoctrineRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Uid\Uuid;

class IssueStatusDoctrineRepository extends AbstractDoctrineRepository implements IssueStatusRepositoryInterface
{
    protected function getEntityClass(): string
    {
        return IssueStatus::class;
    }

    /**
     * @param  Uuid $issueStatusId
     *
     * @return IssueStatus
     * @throws ModelNotFoundException
     * @throws NonUniqueResultException
     */
    public function get(Uuid $issueStatusId): IssueStatus
    {
        $issuePriority = $this->createQueryBuilder('issue_status')
            ->where('issue_status.id = :id')
            ->setParameter('id', $issueStatusId->toBinary())
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