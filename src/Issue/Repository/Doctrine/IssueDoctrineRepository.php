<?php

declare(strict_types=1);

namespace App\Issue\Repository\Doctrine;

use App\Issue\Collection\IssueCollection;
use App\Issue\Model\Issue;
use App\Issue\Repository\IssueRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Repository\AbstractDoctrineRepository;
use Doctrine\ORM\NonUniqueResultException;

class IssueDoctrineRepository extends AbstractDoctrineRepository implements IssueRepositoryInterface
{
    protected function getEntityClass(): string
    {
        return Issue::class;
    }

    /**
     * @param  int $issueId
     *
     * @return Issue
     * @throws ModelNotFoundException
     * @throws NonUniqueResultException
     */
    public function get(int $issueId): Issue
    {
        $project = $this->createQueryBuilder('issue')
            ->where('issue.id = :id')
            ->setParameter('id', $issueId)
            ->getQuery()
            ->getOneOrNullResult();

        if (null === $project) {
            throw new ModelNotFoundException(Issue::class);
        }

        return $project;
    }

    public function getByProjectId(int $projectId): IssueCollection
    {
        $issues = $this->createQueryBuilder('issue')
            ->where('issue.project = :project')
            ->setParameter('project', $projectId)
            ->getQuery()
            ->getResult();

        return new IssueCollection($issues);
    }

    public function all(): IssueCollection
    {
        $issues = $this->createQueryBuilder('issue')
            ->getQuery()
            ->getResult();

        return new IssueCollection($issues);
    }
}