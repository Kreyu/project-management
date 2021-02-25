<?php

declare(strict_types=1);

namespace App\Issue\Collection;

use App\Issue\Model\Issue;
use Doctrine\Common\Collections\ArrayCollection;
use Webmozart\Assert\Assert;

/**
 * @extends ArrayCollection<int, Issue>
 */
class IssueCollection extends ArrayCollection
{
    /**
     * @param array<int, Issue> $elements
     */
    public function __construct(array $elements = [])
    {
        Assert::allIsInstanceOf($elements, Issue::class);

        parent::__construct($elements);
    }
}