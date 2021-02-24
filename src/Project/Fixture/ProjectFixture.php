<?php

declare(strict_types=1);

namespace App\Project\Fixture;

use App\Project\Message\CreateProject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Messenger\MessageBusInterface;

class ProjectFixture extends Fixture
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $message = new CreateProject(
                name: 'Project ' . $i,
                description: 'Project description',
            );

            $this->messageBus->dispatch($message);
        }
    }
}