<?php

declare(strict_types=1);

namespace App\Issue\Collection;

use App\Issue\Model\IssuePriority;
use ArrayIterator;
use Doctrine\Common\Collections\ArrayCollection;
use Exception;
use RuntimeException;
use Webmozart\Assert\Assert;

/**
 * @extends ArrayCollection<int, IssuePriority>
 */
class IssuePriorityCollection extends ArrayCollection
{
    /**
     * @param array<int, IssuePriority> $elements
     */
    public function __construct(array $elements = [])
    {
        Assert::allIsInstanceOf($elements, IssuePriority::class);

        parent::__construct($elements);
    }

    public function sortByPosition(): void
    {
        try {
            $iterator = $this->getIterator();
        } catch (Exception) {
            throw new RuntimeException(sprintf('Unable to retrieve %s iterator.', __CLASS__));
        }

        /** @var ArrayIterator $iterator */

        $iterator->uasort(static function (IssuePriority $a, IssuePriority $b) {
            return $a->getPosition() <=> $b->getPosition();
        });
    }
}