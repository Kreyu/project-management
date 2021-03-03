<?php

declare(strict_types=1);

namespace App\Shared\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Webmozart\Assert\Assert;

abstract class AbstractDoctrineRepository
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return class-string
     */
    abstract protected function getEntityClass(): string;

    protected function createQueryBuilder(string $alias): QueryBuilder
    {
        return $this->entityManager
            ->createQueryBuilder()
            ->select($alias)
            ->from($this->getEntityClass(), $alias);
    }

    public function add(object $entity): void
    {
        Assert::isInstanceOf($entity, $this->getEntityClass());

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function update(object $entity): void
    {
        Assert::isInstanceOf($entity, $this->getEntityClass());

        $this->entityManager->flush();
    }
}