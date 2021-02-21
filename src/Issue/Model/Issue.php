<?php

declare(strict_types=1);

namespace App\Issue\Model;

use App\Project\Model\Project;
use Symfony\Component\Uid\Uuid;

class Issue
{
    private Uuid $id;
    private Project $project;
    private string $subject;
    private string $description;

    public function __construct(Project $project, string $subject, string $description)
    {
        $this->id = Uuid::v4();
        $this->project = $project;
        $this->subject = $subject;
        $this->description = $description;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function setProject(Project $project): void
    {
        $this->project = $project;
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