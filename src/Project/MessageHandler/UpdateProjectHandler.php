<?php

declare(strict_types=1);

namespace App\Project\MessageHandler;

use App\Project\Message\UpdateProject;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Project\Slug\ProjectSlugGenerator;
use App\Shared\Exception\ModelNotFoundException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UpdateProjectHandler implements MessageHandlerInterface
{
    private ProjectRepositoryInterface $repository;
    private ProjectSlugGenerator $slugGenerator;

    public function __construct(ProjectRepositoryInterface $repository, ProjectSlugGenerator $slugGenerator)
    {
        $this->repository = $repository;
        $this->slugGenerator = $slugGenerator;
    }

    /**
     * @param  UpdateProject $command
     *
     * @throws ModelNotFoundException
     */
    public function __invoke(UpdateProject $command): void
    {
        $project = $this->repository->get($command->getProjectId());

        $project->setName($command->getName());
        $project->setDescription($command->getDescription());
        $project->setSlug($this->slugGenerator->generate($command->getName()));

        $this->repository->update($project);
    }
}