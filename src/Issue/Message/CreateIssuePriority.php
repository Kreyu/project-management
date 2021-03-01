<?php

declare(strict_types=1);

namespace App\Issue\Message;

class CreateIssuePriority
{
    private string $name;
    private string $description;
    private string $icon;

    public function __construct(string $name, string $description, string $icon)
    {
        $this->name = $name;
        $this->description = $description;
        $this->icon = $icon;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }
}