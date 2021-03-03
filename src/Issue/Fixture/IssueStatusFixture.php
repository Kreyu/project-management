<?php

declare(strict_types=1);

namespace App\Issue\Fixture;

use App\Issue\Message\CreateIssueStatus;
use App\Shared\Fixture\AbstractFixture;
use Doctrine\Persistence\ObjectManager;

class IssueStatusFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $statuses = [
            'Open' => '2fb344',
            'In Progress' => 'f76707',
            'Done' => '656d77',
        ];

        foreach ($statuses as $name => $colorHex) {
            $message = new CreateIssueStatus(
                name: $name,
                description: 'Issue status description',
                colorHex: $colorHex,
            );

            $this->dispatchMessage($message);
        }

        $manager->flush();
    }
}