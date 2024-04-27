<?php

namespace App\Command;

use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(name: 'notifications:listen')]
class ListenNotificationCommand extends Command
{
    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $connection = new AMQPStreamConnection(
            'notification-rabbitmq',
            5672,
            'user',
            'password'
        );
        $channel = $connection->channel();

        $channel->queue_declare('notifications-queue', false, false, false, false);

        $output->writeln(" [*] Waiting for messages");

        $callback = function (AMQPMessage $msg) use ($output) {
            $output->writeln(" [x] Message received from routing key: " . $msg->getRoutingKey());
        };

        $channel->basic_consume('notifications-queue', '', false, true, false, false, $callback);

        try {
            $channel->consume();
        } catch (Throwable $exception) {
            echo $exception->getMessage();
        }

        $channel->close();
        $connection->close();

        return Command::SUCCESS;
    }
}