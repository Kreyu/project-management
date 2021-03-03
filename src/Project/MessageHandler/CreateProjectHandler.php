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
    private ProjectRepositoryInterface $projectRepository;
    private ProjectSlugGenerator $slugGenerator;

    public function __construct(ProjectRepositoryInterface $projectRepository, ProjectSlugGenerator $slugGenerator)
    {
        $this->projectRepository = $projectRepository;
        $this->slugGenerator = $slugGenerator;
    }

    public function __invoke(CreateProject $command): void
    {
        $project = new Project(
            name: $command->getName(),
            description: $command->getDescription(),
        );

        $this->projectRepository->add($project);
    }
}