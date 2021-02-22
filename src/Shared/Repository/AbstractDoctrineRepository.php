<?php

declare(strict_types=1);

namespace App\Shared\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

abstract class AbstractDoctrineRepository
{
    protected EntityManagerInterface $entityManager;
    protected EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = new EntityRepository(
            $entityManager,
            $entityManager->getClassMetadata(static::getEntityClass())
        );
    }

    /**
     * @return class-string
     */
    abstract public static function getEntityClass(): string;
}