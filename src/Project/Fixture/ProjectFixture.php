<?php

declare(strict_types=1);

namespace App\Project\Fixture;

use App\Project\Message\CreateProject;
use App\Shared\Fixture\AbstractFixture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Messenger\MessageBusInterface;

class ProjectFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $message = new CreateProject(
                name: 'Project ' . $i,
                description: $this->faker->realText(1500),
            );

            $this->dispatchMessage($message);
        }
    }
}