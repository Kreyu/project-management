<?php

declare(strict_types=1);

namespace App\Project\MessageHandler;

use App\Project\Model\Project;
use App\Project\Message\CreateProject;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Project\Slug\ProjectSlugGenerator;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateProjectHandler implements MessageHandlerInterface
{
    private ProjectRepositoryInterface $repository;
    private ProjectSlugGenerator $slugGenerator;

    public function __construct(ProjectRepositoryInterface $repository, ProjectSlugGenerator $slugGenerator)
    {
        $this->repository = $repository;
        $this->slugGenerator = $slugGenerator;
    }

    public function __invoke(CreateProject $command): void
    {
        $slug = $this->slugGenerator->generate($command->getName());

        $project = new Project(
            name: $command->getName(),
            description: $command->getDescription(),
            slug: $slug,
        );

        $this->repository->add($project);
    }
}