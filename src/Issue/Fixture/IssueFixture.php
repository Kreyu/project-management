<?php

declare(strict_types=1);

namespace App\Issue\Fixture;

use App\Issue\Message\CreateIssue;
use App\Issue\Repository\IssuePriorityRepositoryInterface;
use App\Issue\Repository\IssueStatusRepositoryInterface;
use App\Project\Fixture\ProjectFixture;
use App\Project\Repository\ProjectRepositoryInterface;
use App\Shared\Fixture\AbstractFixture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Exception;
use LogicException;
use Symfony\Component\Messenger\MessageBusInterface;

class IssueFixture extends AbstractFixture implements DependentFixtureInterface
{
    private ProjectRepositoryInterface $projectRepository;
    private IssuePriorityRepositoryInterface $issuePriorityRepository;
    private IssueStatusRepositoryInterface $issueStatusRepository;

    public function __construct(
        MessageBusInterface $messageBus,
        ProjectRepositoryInterface $projectRepository,
        IssuePriorityRepositoryInterface $issuePriorityRepository,
        IssueStatusRepositoryInterface $issueStatusRepository,
    ) {
        parent::__construct($messageBus);

        $this->projectRepository = $projectRepository;
        $this->issuePriorityRepository = $issuePriorityRepository;
        $this->issueStatusRepository = $issueStatusRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $projects = $this->projectRepository->all();
        $priorities = $this->issuePriorityRepository->all();
        $statuses = $this->issueStatusRepository->all();

        foreach ($projects as $project) {
            foreach ($priorities as $priority) {
                foreach ($statuses as $status) {
                    $message = new CreateIssue(
                        projectId: $project->getId(),
                        subject: 'Issue subject',
                        description: $this->faker->realText(1500),
                        priorityId: $priority->getId(),
                        statusId: $status->getId()
                    );

                    $this->dispatchMessage($message);
                }
            }
        }
    }

    public function getDependencies(): iterable
    {
        return [
            ProjectFixture::class,
            IssuePriorityFixture::class,
            IssueStatusFixture::class,
        ];
    }
}