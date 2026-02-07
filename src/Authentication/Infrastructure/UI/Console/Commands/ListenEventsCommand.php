<?php

namespace Authentication\Infrastructure\UI\Console\Commands;

use Authentication\Application\Services\Event\EventRetrieved;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

#[AsCommand(
    name: 'notification:listen-events',
    description: 'Creates a new user.',
)]
class ListenEventsCommand extends Command
{
    private EventRetrieved $eventRetrieved;
    private ContainerBagInterface $params;

    public function __construct(EventRetrieved $eventRetrieved, ContainerBagInterface $params)
    {
        parent::__construct();
        $this->eventRetrieved = $eventRetrieved;
        $this->params = $params;
    }

    /**
     * @throws \ErrorException
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info>Starting...</info>');

        $callback = fn(AMQPMessage $message) => $output->writeln($message->getBody());

        $connection = new AMQPStreamConnection(
            $this->params->get('rabbitmq.host'),
            $this->params->get('rabbitmq.port'),
            $this->params->get('rabbitmq.user'),
            $this->params->get('rabbitmq.password')
        );
        $queueName = 'notifications';

        $channel = $connection->channel();

        $channel->queue_declare(
            $queueName,
            false,
            false,
            false,
            false
        );

        $channel->basic_consume(
            $queueName,
            'consumer',
            false,
            true,
            false,
            false,
            $callback
        );

        $output->writeln('<info>Waiting for messages</info>');

        $channel->consume();

        return parent::SUCCESS;
    }
}