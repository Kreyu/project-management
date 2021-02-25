<?php

declare(strict_types=1);

namespace App\Issue\Fixture;

use App\Issue\Message\CreateIssue;
use App\Project\Fixture\ProjectFixture;
use App\Project\Repository\ProjectRepositoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use LogicException;
use Symfony\Component\Messenger\MessageBusInterface;

class IssueFixture extends Fixture implements DependentFixtureInterface
{
    private MessageBusInterface $messageBus;
    private ProjectRepositoryInterface $projectRepository;

    public function __construct(MessageBusInterface $messageBus, ProjectRepositoryInterface $projectRepository)
    {
        $this->messageBus = $messageBus;
        $this->projectRepository = $projectRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $projects = $this->projectRepository->all();

        foreach ($projects as $project) {
            for ($i = 1; $i <= 10; $i++) {
                $message = new CreateIssue(
                    projectId: $project->getId(),
                    subject: 'Issue ' . $i,
                    description: 'Issue description',
                );

                $this->messageBus->dispatch($message);
            }
        }
    }

    public function getDependencies(): iterable
    {
        return [
            ProjectFixture::class,
        ];
    }
}