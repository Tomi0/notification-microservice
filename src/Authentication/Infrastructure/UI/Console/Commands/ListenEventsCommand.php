<?php

namespace Authentication\Infrastructure\UI\Console\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'notification:listen-events',
    description: 'Creates a new user.',
)]
class ListenEventsCommand extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        while (true) {
            $output->writeln('<info>Hello world</info>');
            sleep(2);
        }

        return parent::SUCCESS;
    }
}