<?php

declare(strict_types=1);

namespace App\Project\Model;

use Symfony\Component\Uid\Uuid;

class Project
{
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
    }

    public function getId(): Uuid
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