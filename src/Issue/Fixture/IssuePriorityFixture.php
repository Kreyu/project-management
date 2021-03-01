<?php

declare(strict_types=1);

namespace App\Issue\Fixture;

use App\Issue\Message\CreateIssuePriority;
use App\Issue\Model\IssuePriority;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Messenger\MessageBusInterface;

class IssuePriorityFixture extends Fixture
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

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

            $this->messageBus->dispatch($message);
        }

        $manager->flush();
    }
}