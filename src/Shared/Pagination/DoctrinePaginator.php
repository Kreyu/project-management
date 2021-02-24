<?php

declare(strict_types=1);

namespace App\Shared\Pagination;

use ArrayIterator;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Traversable;

class DoctrinePaginator implements PaginatorInterface
{
    private Paginator $paginator;

    private int $page;
    private int $perPage;

    public function __construct(QueryBuilder $queryBuilder, int $page, int $perPage)
    {
        $queryBuilder->setFirstResult(($page - 1) * $perPage);
        $queryBuilder->setMaxResults($perPage);

        $this->paginator = new Paginator($queryBuilder);

        $this->page = $page;
        $this->perPage = $perPage;
    }

    public function getIterator(): Traversable|ArrayIterator
    {
        return $this->paginator->getIterator();
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }
}
