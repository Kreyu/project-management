<?php

declare(strict_types=1);

namespace App\Project\Form\Data;

use App\Project\Entity\Project;

class ProjectData
{
    public mixed $name;
    public mixed $description;

    public static function createFromProject(Project $project): self
    {
        $data = new self;
        $data->name = $project->getName();
        $data->description = $project->getDescription();

        return $data;
    }
}