<?php

declare(strict_types=1);

namespace App\Issue\Collection;

use App\Issue\Model\IssueStatus;
use Doctrine\Common\Collections\ArrayCollection;
use Webmozart\Assert\Assert;

/**
 * @extends ArrayCollection<int, IssueStatus>
 */
class IssueStatusCollection extends ArrayCollection
{
    /**
     * @param array<int, IssueStatus> $elements
     */
    public function __construct(array $elements = [])
    {
        Assert::allIsInstanceOf($elements, IssueStatus::class);

        parent::__construct($elements);
    }
}