<?php

declare(strict_types=1);

namespace App\Issue\Model;

use App\Shared\Model\SortableTrait;
use Symfony\Component\Uid\Uuid;

class IssuePriority
{
    use SortableTrait;

    private Uuid $id;
    private string $name;
    private string $description;
    private string $icon;

    public function __construct(string $name, string $description, string $icon)
    {
        $this->id = Uuid::v4();
        $this->name = $name;
        $this->description = $description;
        $this->icon = $icon;
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

    public function getIcon(): string
    {
        return $this->icon;
    }
}