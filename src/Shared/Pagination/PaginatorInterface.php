<?php

declare(strict_types=1);

namespace App\Shared\Pagination;

use IteratorAggregate;

interface PaginatorInterface extends IteratorAggregate
{
    public function getPage(): int;

    public function getPerPage(): int;
}