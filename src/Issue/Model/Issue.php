<?php

declare(strict_types=1);

namespace App\Issue\Model;

use App\Issue\Collection\IssuePriorityCollection;
use App\Project\Model\Project;
use App\Shared\Model\TimestampableTrait;
use DateTime;
use Symfony\Component\Uid\Uuid;

class Issue
{
    use TimestampableTrait;

    private Uuid $id;
    private Project $project;
    private string $subject;
    private string $description;
    private IssuePriority $priority;
    private IssueStatus $status;

    public function __construct(
        Project $project,
        string $subject,
        string $description,
        IssuePriority $priority,
        IssueStatus $status,
    ) {
        $this->id = Uuid::v4();
        $this->project = $project;
        $this->subject = $subject;
        $this->description = $description;
        $this->priority = $priority;
        $this->status = $status;

        $this->initTimestamps();
    }

    public function update(
        string $subject,
        string $description,
        IssuePriority $priority,
        IssueStatus $status,
    ): void {
        $this->subject = $subject;
        $this->description = $description;
        $this->priority = $priority;
        $this->status = $status;

        $this->updatedAt = new DateTime;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPriority(): IssuePriority
    {
        return $this->priority;
    }

    public function getStatus(): IssueStatus
    {
        return $this->status;
    }
}