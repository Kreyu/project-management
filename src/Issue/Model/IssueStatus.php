<?php

declare(strict_types=1);

namespace App\Issue\Model;

use Symfony\Component\Uid\Uuid;

class IssueStatus
{
    private Uuid $id;
    private string $name;
    private string $description;
    private string $colorHex;

    public function __construct(string $name, string $description, string $colorHex)
    {
        $this->id = Uuid::v4();
        $this->name = $name;
        $this->description = $description;
        $this->colorHex = $colorHex;
    }

    public function getId(): Uuid
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