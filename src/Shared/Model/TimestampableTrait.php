<?php

declare(strict_types=1);

namespace App\Shared\Model;

use DateTimeInterface;

trait TimestampableTrait
{
    private DateTimeInterface $createdAt;
    private DateTimeInterface $updatedAt;

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }
}