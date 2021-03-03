<?php

declare(strict_types=1);

namespace App\Issue\Model;

use App\Shared\Model\SortableTrait;

class IssuePriority
{
    use SortableTrait;

    private int $id;
    private string $name;
    private string $description;
    private string $icon;

    public function __construct(string $name, string $description, string $icon)
    {
        $this->name = $name;
        $this->description = $description;
        $this->icon = $icon;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }
}