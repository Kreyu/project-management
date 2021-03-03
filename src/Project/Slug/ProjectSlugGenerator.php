<?php

declare(strict_types=1);

namespace App\Project\Slug;

use App\Project\Model\Project;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Slug\SlugGeneratorInterface;

class ProjectSlugGenerator
{
    private SlugGeneratorInterface $slugGenerator;
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(SlugGeneratorInterface $slugGenerator, ProjectRepositoryInterface $projectRepository)
    {
        $this->slugGenerator = $slugGenerator;
        $this->projectRepository = $projectRepository;
    }

    public function generate(Project $project): string
    {
        static $suffix = null;

        $slug = $this->slugGenerator->generate($project->getName(), $suffix);

        try {
            $existingProject = $this->projectRepository->getBySlug($slug);
        } catch (ModelNotFoundException) {
            return $slug;
        }

        if ($project->getId()->equals($existingProject->getId())) {
            return $slug;
        }

        if (null === $suffix) {
            $suffix = 0;
        }

        return $this->generate($project);
    }
}