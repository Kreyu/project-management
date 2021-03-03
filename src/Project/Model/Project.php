<?php

declare(strict_types=1);

namespace App\Project\Model;

use App\Shared\Model\TimestampableTrait;
use DateTime;
use Symfony\Component\Uid\Uuid;

class Project
{
    use TimestampableTrait;

    private int $id;
    private string $name;
    private string $description;
    private string $slug;

    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
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

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
}