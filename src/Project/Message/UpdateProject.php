<?php

declare(strict_types=1);

namespace App\Project\Message;

use Symfony\Component\Uid\Uuid;

class UpdateProject
{
    private Uuid $projectId;
    private string $name;
    private string $description;

    public function __construct(Uuid $projectId, string $name, string $description)
    {
        $this->projectId = $projectId;
        $this->name = $name;
        $this->description = $description;
    }

    public function getProjectId(): Uuid
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