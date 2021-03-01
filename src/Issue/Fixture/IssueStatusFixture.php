<?php

declare(strict_types=1);

namespace App\Issue\Fixture;

use App\Issue\Model\IssueStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class IssueStatusFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $statuses = [
            'Open' => '2fb344',
            'In Progress' => 'f76707',
            'Done' => '656d77',
        ];

        foreach ($statuses as $name => $colorHex) {
            $manager->persist(new IssueStatus(
                name: $name,
                description: 'Issue status description',
                colorHex: $colorHex,
            ));
        }

        $manager->flush();
    }
}