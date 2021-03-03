<?php

declare(strict_types=1);

namespace App\Issue\Message;

use App\Issue\Form\Data\IssueData;

class CreateIssue
{
    private int $projectId;
    private string $subject;
    private string $description;
    private int $priorityId;
    private int $statusId;

    public function __construct(
        int $projectId,
        string $subject,
        string $description,
        int $priorityId,
        int $statusId
    ) {
        $this->projectId = $projectId;
        $this->subject = $subject;
        $this->description = $description;
        $this->priorityId = $priorityId;
        $this->statusId = $statusId;
    }

    public static function createFromIssueData(IssueData $data): self
    {
        return new self(
            projectId: $data->project->getId(),
            subject: $data->subject,
            description: $data->description,
            priorityId: $data->priority->getId(),
            statusId: $data->status->getId(),
        );
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPriorityId(): int
    {
        return $this->priorityId;
    }

    public function getStatusId(): int
    {
        return $this->statusId;
    }
}