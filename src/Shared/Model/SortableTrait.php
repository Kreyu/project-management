<?php

declare(strict_types=1);

namespace App\Shared\Model;

trait SortableTrait
{
    private int $position;

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }
}