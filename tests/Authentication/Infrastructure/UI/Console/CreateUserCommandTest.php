<?php

namespace Tests\Authentication\Infrastructure\UI\Console;

use Authentication\Application\Service\User\CreateUser;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Tests\TestCase;

class CreateUserCommandTest extends TestCase
{

    public function testCallCreateUserServiceSuccessfully(): void
    {
        $mockCreateUser = $this->createMock(CreateUser::class);
        $mockCreateUser->expects($this->once())->method('handle');
        self::getContainer()->set(CreateUser::class, $mockCreateUser);

        $application = new Application(self::$kernel);

        $command = $application->find('user:create');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('User access token: ', $output);
    }
}