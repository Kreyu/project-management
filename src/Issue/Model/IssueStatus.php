<?php

declare(strict_types=1);

namespace App\Issue\Model;

class IssueStatus
{
    private int $id;
    private string $name;
    private string $description;
    private string $colorHex;

    public function __construct(string $name, string $description, string $colorHex)
    {
        $this->name = $name;
        $this->description = $description;
        $this->colorHex = $colorHex;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getColorHex(): string
    {
        return $this->colorHex;
    }
}