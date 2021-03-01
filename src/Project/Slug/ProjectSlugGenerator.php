<?php

declare(strict_types=1);

namespace App\Project\Slug;

use App\Project\Repository\ProjectRepositoryInterface;
use App\Shared\Exception\ModelNotFoundException;
use App\Shared\Slug\SlugGeneratorInterface;

class ProjectSlugGenerator implements SlugGeneratorInterface
{
    private SlugGeneratorInterface $slugGenerator;
    private ProjectRepositoryInterface $repository;

    public function __construct(SlugGeneratorInterface $slugGenerator, ProjectRepositoryInterface $repository)
    {
        $this->slugGenerator = $slugGenerator;
        $this->entityRepository = $repository;
    }

    public function generate(string $subject, ?int $suffix = null): string
    {
        $slug = $this->slugGenerator->generate($subject, $suffix);

        try {
            $this->entityRepository->getBySlug($slug);
        } catch (ModelNotFoundException) {
            return $slug;
        }

        if (null === $suffix) {
            $suffix = 0;
        }

        return $this->generate($subject, ++$suffix);
    }
}