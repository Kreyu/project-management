<?php

declare(strict_types=1);

namespace App\Task\Fixture;

use App\Issue\Fixture\IssueFixture;
use App\Issue\Repository\IssueRepositoryInterface;
use App\Task\Message\CreateTask;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Messenger\MessageBusInterface;

class TaskFixture extends Fixture implements DependentFixtureInterface
{
    private MessageBusInterface $messageBus;
    private IssueRepositoryInterface $issueRepository;

    public function __construct(MessageBusInterface $messageBus, IssueRepositoryInterface $issueRepository)
    {
        $this->messageBus = $messageBus;
        $this->issueRepository = $issueRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $issues = $this->issueRepository->all();

        foreach ($issues as $issue) {
            for ($i = 1; $i <= 10; $i++) {
                $message = new CreateTask(
                    issueId: $issue->getId(),
                    subject: 'Task ' . $i,
                    description: 'Task description',
                );

                $this->messageBus->dispatch($message);
            }
        }
    }

    public function getDependencies(): iterable
    {
        return [
            IssueFixture::class,
        ];
    }
}