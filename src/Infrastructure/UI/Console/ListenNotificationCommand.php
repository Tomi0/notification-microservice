<?php

namespace App\Infrastructure\UI\Console;

use App\Application\Service\NotificationRequest\RequestNotification;
use App\Application\Service\NotificationRequest\RequestNotificationInput;
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
use UnexpectedValueException;

#[AsCommand(name: 'notifications:listen')]
class ListenNotificationCommand extends Command
{
    private ContainerBagInterface $containerBag;
    private RequestNotification $requestNotification;

    public function __construct(ContainerBagInterface $containerBag,
                                RequestNotification   $requestNotification)
    {
        parent::__construct();
        $this->containerBag = $containerBag;
        $this->requestNotification = $requestNotification;
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
            $routingKey = $msg->getRoutingKey();
            if ( ! $routingKey) {
                throw new UnexpectedValueException("Routing key not found");
            }
            $output->writeln(
                $this->requestNotification->handle(new RequestNotificationInput(
                    $routingKey,
                    $msg->getBody()
                ))
            );
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