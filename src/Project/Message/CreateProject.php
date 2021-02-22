<?php

declare(strict_types=1);

namespace App\Project\Message;

use App\Project\Form\Data\ProjectData;

class CreateProject
{
    private string $name;
    private string $description;

    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public static function createFromProjectData(ProjectData $data): self
    {
        return new self(
            name: $data->name,
            description: $data->description,
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}