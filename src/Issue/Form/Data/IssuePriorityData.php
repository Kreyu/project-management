<?php

declare(strict_types=1);

namespace App\Issue\Form\Data;

use App\Issue\Model\IssuePriority;

class IssuePriorityData
{
    public mixed $name;
    public mixed $description;
    public mixed $icon;

    public static function createFromIssuePriority(IssuePriority $issuePriority): self
    {
        $data = new self;

        $data->name = $issuePriority->getName();
        $data->description = $issuePriority->getDescription();
        $data->icon = $issuePriority->getIcon();

        return $data;
    }
}