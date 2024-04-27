<?php

namespace App\Command;

use Exception;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Throwable;

#[AsCommand(name: 'notifications:listen')]
class ListenNotificationCommand extends Command
{
    private ContainerBagInterface $containerBag;

    public function __construct(ContainerBagInterface $containerBag)
    {
        parent::__construct();
        $this->containerBag = $containerBag;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $queueName = $this->containerBag->get('queue.name');
        $queueHost = $this->containerBag->get('queue.host');
        $queuePort = $this->containerBag->get('queue.port');
        $queueUser = $this->containerBag->get('queue.user');
        $queuePassword = $this->containerBag->get('queue.password');

        $connection = new AMQPStreamConnection(
            $queueHost,
            $queuePort,
            $queueUser,
            $queuePassword
        );
        $channel = $connection->channel();

        $channel->queue_declare($queueName, false, false, false, false);

        $output->writeln(" [*] Waiting for messages on queue: " . $queueName);

        $callback = function (AMQPMessage $msg) use ($output) {
            $output->writeln(" [x] Message received from routing key: " . $msg->getRoutingKey());
        };

        $channel->basic_consume($queueName, '', false, true, false, false, $callback);

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