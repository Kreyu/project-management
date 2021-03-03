<?php

declare(strict_types=1);

namespace App\Issue\MessageHandler;

use App\Issue\Message\CreateIssuePriority;
use App\Issue\Model\IssuePriority;
use App\Issue\Repository\IssuePriorityRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateIssuePriorityHandler implements MessageHandlerInterface
{
    private IssuePriorityRepositoryInterface $issuePriorityRepository;

    public function __construct(IssuePriorityRepositoryInterface $issuePriorityRepository)
    {
        $this->issuePriorityRepository = $issuePriorityRepository;
    }

    public function __invoke(CreateIssuePriority $command): void
    {
        $issuePriority = new IssuePriority(
            name: $command->getName(),
            description: $command->getDescription(),
            icon: $command->getIcon(),
        );

        $this->issuePriorityRepository->add($issuePriority);
    }
}