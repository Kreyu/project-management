<?php

declare(strict_types=1);

namespace App\Project\Collection;

use App\Project\Model\Project;
use Doctrine\Common\Collections\ArrayCollection;
use Webmozart\Assert\Assert;

/**
 * @extends ArrayCollection<int, Project>
 */
class ProjectCollection extends ArrayCollection
{
    /**
     * @param array<int, Project> $elements
     */
    public function __construct(array $elements = [])
    {
        Assert::allIsInstanceOf($elements, Project::class);

        parent::__construct($elements);
    }
}