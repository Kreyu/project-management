<?php

declare(strict_types=1);

namespace App\Task\Message;

use App\Task\Form\Data\TaskData;
use Symfony\Component\Uid\Uuid;

class CreateTask
{
    private Uuid $issueId;
    private string $subject;
    private string $description;

    public function __construct(Uuid $issueId, string $subject, string $description)
    {
        $this->issueId = $issueId;
        $this->subject = $subject;
        $this->description = $description;
    }

    public static function createFromTaskData(TaskData $data): self
    {
        return new self(
            issueId: $data->issue->getId(),
            subject: $data->subject,
            description: $data->description,
        );
    }

    public function getIssueId(): Uuid
    {
        return $this->issueId;
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