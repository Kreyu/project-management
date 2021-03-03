<?php

declare(strict_types=1);

namespace App\Issue\Form\Data;

use App\Issue\Model\Issue;

class IssueData
{
    public mixed $project;
    public mixed $subject;
    public mixed $description;
    public mixed $priority;
    public mixed $status;

    public static function createFromIssue(Issue $issue): self
    {
        $data = new self;

        $data->project = $issue->getProject();
        $data->subject = $issue->getSubject();
        $data->description = $issue->getDescription();
        $data->priority = $issue->getPriority();
        $data->status = $issue->getStatus();

        return $data;
    }
}