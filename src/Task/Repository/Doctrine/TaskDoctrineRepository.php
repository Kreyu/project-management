<?php

declare(strict_types=1);

namespace App\Task\Repository\Doctrine;

use App\Task\Collection\TaskCollection;
use App\Task\Model\Task;
use App\Task\Repository\TaskRepositoryInterface;
use App\Shared\Repository\AbstractDoctrineRepository;
use Symfony\Component\Uid\Uuid;

class TaskDoctrineRepository extends AbstractDoctrineRepository implements TaskRepositoryInterface
{
    public static function getEntityClass(): string
    {
        return Task::class;
    }

    public function getByProjectId(Uuid $projectId): TaskCollection
    {
        $tasks = $this->repository->createQueryBuilder('task')
            ->innerJoin('task.issue', 'issue')
            ->where('issue.project = :project')
            ->setParameter('project', $projectId->toBinary())
            ->getQuery()
            ->getResult();

        return new TaskCollection($tasks);
    }

    public function getByIssueId(Uuid $issueId): TaskCollection
    {
        $tasks = $this->repository->createQueryBuilder('task')
            ->where('task.issue = :issue')
            ->setParameter('issue', $issueId->toBinary())
            ->getQuery()
            ->getResult();

        return new TaskCollection($tasks);
    }

    public function add(Task $task): void
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }
}