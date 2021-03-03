<?php

declare(strict_types=1);

namespace App\Shared\Fixture;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class AbstractFixture extends Fixture
{
    protected Generator $faker;
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->faker = Factory::create();
        $this->messageBus = $messageBus;
    }

    protected function dispatchMessage(object $message): void
    {
        $this->messageBus->dispatch($message);
    }
}