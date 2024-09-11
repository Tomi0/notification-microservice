<?php

namespace Authentication\Infrastructure\UI\Console;

use Authentication\Application\Service\User\CreateUser;
use Authentication\Application\Service\User\CreateUserRequest;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'user:create')]
class CreateUserCommand extends Command
{

    private CreateUser $createUser;

    public function __construct(CreateUser $createUser)
    {
        parent::__construct();
        $this->createUser = $createUser;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = $this->createUser->handle(new CreateUserRequest());

        $output->writeln("User access token: " . $user->accessToken());

        return Command::SUCCESS;
    }


}