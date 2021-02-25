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

    public function __construct(Uuid $projectId, string $subject, string $description)
    {
        $this->projectId = $projectId;
        $this->subject = $subject;
        $this->description = $description;
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
}