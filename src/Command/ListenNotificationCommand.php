<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'notifications:listen')]
class ListenNotificationCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        while (true) {
            $output->writeln('Listening for notifications...');
            sleep(3);
        }

        return Command::SUCCESS;
    }
}