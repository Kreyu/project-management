<?php

declare(strict_types=1);

namespace App\Shared\Pagination\Doctrine;

use App\Shared\Pagination\PaginatorInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

abstract class AbstractDoctrinePaginator implements PaginatorInterface
{
    protected Paginator $paginator;

    protected int $page;
    protected int $perPage;

    public function __construct(QueryBuilder $queryBuilder, int $page, int $perPage)
    {
        $queryBuilder->setFirstResult(($page - 1) * $perPage);
        $queryBuilder->setMaxResults($perPage);

        $this->paginator = new Paginator($queryBuilder);

        $this->page = $page;
        $this->perPage = $perPage;
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
