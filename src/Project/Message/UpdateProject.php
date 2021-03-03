<?php

declare(strict_types=1);

namespace App\Project\Message;

use App\Project\Form\Data\ProjectData;

class UpdateProject
{
    private int $projectId;
    private string $name;
    private string $description;

    public function __construct(int $projectId, string $name, string $description)
    {
        $this->projectId = $projectId;
        $this->name = $name;
        $this->description = $description;
    }

    public static function createFromProjectData(ProjectData $data, int $projectId): self
    {
        return new self(
            projectId: $projectId,
            name: $data->name,
            description: $data->description,
        );
    }

    public function getProjectId(): int
    {
        return $this->projectId;
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