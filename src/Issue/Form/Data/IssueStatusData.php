<?php

declare(strict_types=1);

namespace App\Issue\Form\Data;

use App\Issue\Model\IssueStatus;

class IssueStatusData
{
    public mixed $name;
    public mixed $description;
    public mixed $colorHex;

    public static function createFromIssueStatus(IssueStatus $issueStatus): self
    {
        $data = new self;

        $data->name = $issueStatus->getName();
        $data->description = $issueStatus->getDescription();
        $data->colorHex = $issueStatus->getColorHex();

        return $data;
    }
}