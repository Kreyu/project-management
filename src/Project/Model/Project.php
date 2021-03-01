<?php

declare(strict_types=1);

namespace App\Project\Model;

use App\Shared\Model\TimestampableTrait;
use DateTime;
use Symfony\Component\Uid\Uuid;

class Project
{
    use TimestampableTrait;

    private Uuid $id;
    private string $name;
    private string $description;
    private string $slug;

    public function __construct(string $name, string $description, string $slug)
    {
        $this->id = Uuid::v4();
        $this->name = $name;
        $this->description = $description;
        $this->slug = $slug;

        $this->initTimestamps();
    }

    public function update(string $name, string $description, string $slug): void
    {
        $this->name = $name;
        $this->description = $description;
        $this->slug = $slug;

        $this->updatedAt = new DateTime;
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

    public function getSlug(): string
    {
        return $this->slug;
    }
}