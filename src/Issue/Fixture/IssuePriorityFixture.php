<?php

declare(strict_types=1);

namespace App\Issue\Fixture;

use App\Issue\Message\CreateIssuePriority;
use App\Shared\Fixture\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

class IssuePriorityFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $priorities = [
            'Highest' => 'chevrons-up',
            'High' => 'chevron-up',
            'Medium' => 'menu',
            'Low' => 'chevron-down',
            'Lowest' => 'chevrons-down',
        ];

        foreach ($priorities as $name => $icon) {
            $message = new CreateIssuePriority(
                name: $name,
                description: 'Issue priority description',
                icon: $icon,
            );

            $this->dispatchMessage($message);
        }

        $manager->flush();
    }
}