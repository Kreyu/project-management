<?php

declare(strict_types=1);

namespace App\Issue\Message;

use App\Issue\Form\Data\IssueData;
use Symfony\Component\Uid\Uuid;

class CreateIssue
{
    private Uuid $projectId;
    private string $subject;
    private string $description;
    private Uuid $priorityId;
    private Uuid $statusId;

    public function __construct(
        Uuid $projectId,
        string $subject,
        string $description,
        Uuid $priorityId,
        Uuid $statusId
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
        );
    }

    public function getProjectId(): Uuid
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

    public function getPriorityId(): Uuid
    {
        return $this->priorityId;
    }

    public function setPriorityId(Uuid $priorityId): void
    {
        $this->priorityId = $priorityId;
    }

    public function getStatusId(): Uuid
    {
        return $this->statusId;
    }

    public function setStatusId(Uuid $statusId): void
    {
        $this->statusId = $statusId;
    }
}