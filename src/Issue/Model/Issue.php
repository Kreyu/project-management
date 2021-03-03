<?php

declare(strict_types=1);

namespace App\Issue\Model;

use App\Project\Model\Project;
use App\Shared\Model\TimestampableTrait;

class Issue
{
    use TimestampableTrait;

    private int $id;
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
        $this->project = $project;
        $this->subject = $subject;
        $this->description = $description;
        $this->priority = $priority;
        $this->status = $status;
    }

    public function getId(): int
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

    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPriority(): IssuePriority
    {
        return $this->priority;
    }

    public function setPriority(IssuePriority $priority): void
    {
        $this->priority = $priority;
    }

    public function getStatus(): IssueStatus
    {
        return $this->status;
    }

    public function setStatus(IssueStatus $status): void
    {
        $this->status = $status;
    }
}