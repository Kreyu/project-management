<?php

declare(strict_types=1);

namespace App\Task\Model;

use App\Issue\Model\Issue;
use Symfony\Component\Uid\Uuid;

class Task
{
    private Uuid $id;
    private Issue $issue;
    private string $subject;
    private string $description;

    public function __construct(Issue $issue, string $subject, string $description)
    {
        $this->id = Uuid::v4();
        $this->issue = $issue;
        $this->subject = $subject;
        $this->description = $description;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getIssue(): Issue
    {
        return $this->issue;
    }

    public function setIssue(Issue $issue): void
    {
        $this->issue = $issue;
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
}