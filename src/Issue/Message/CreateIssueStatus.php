<?php

declare(strict_types=1);

namespace App\Issue\Message;

class CreateIssueStatus
{
    private string $name;
    private string $description;
    private string $colorHex;

    public function __construct(string $name, string $description, string $colorHex)
    {
        $this->name = $name;
        $this->description = $description;
        $this->colorHex = $colorHex;
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