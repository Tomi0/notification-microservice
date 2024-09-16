<?php

namespace Tests\Notifications\Application\Service\NotificationRequest;

use Notifications\Application\Service\NotificationRequest\RequestNotification;
use Notifications\Application\Service\NotificationRequest\RequestNotificationRequest;
use Notifications\Domain\Model\DeliveryChannel\DeliveryChannel;
use Notifications\Domain\Model\NotificationRequest\NotificationRequest;
use Tests\TestCase;

class RequestNotificationTest extends TestCase
{
    private RequestNotification $requestNotification;

    protected function setUp(): void
    {
        parent::setUp();
        $this->initService();
    }

    private function initService(): void
    {
        $this->requestNotification = self::getContainer()->get(RequestNotification::class);
    }

    public function testRequestNotification()
    {
        $ret = $this->requestNotification->handle(new RequestNotificationRequest(
            DeliveryChannel::EMAIL->value,
            'test@email.com',
            'Test Subject',
            'Test Content',
            'test-user-id'
        ));

        $this->assertInstanceOf(NotificationRequest::class, $ret);
    }

    public function testNotificationRequestIsPersistedInDatabase(): void
    {
        $ret = $this->requestNotification->handle(new RequestNotificationRequest(
            DeliveryChannel::EMAIL->value,
            'test@email.com',
            'Test Subject',
            'Test Content',
            'test-user-id'
        ));

        $entityManager = self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        /** @var NotificationRequest $notificationRequest */
        $notificationRequest = $entityManager
            ->getRepository(NotificationRequest::class)
            ->findOneBy(['id' => $ret->id()]);

        $this->assertNotNull($notificationRequest);
        $this->assertSame($ret->id(), $notificationRequest->id());
        $this->assertEquals($ret->deliveryChannel(), $notificationRequest->deliveryChannel());
        $this->assertSame($ret->to(), $notificationRequest->to());
        $this->assertSame($ret->subject(), $notificationRequest->subject());
        $this->assertSame($ret->content(), $notificationRequest->content());
        $this->assertSame($ret->userId(), $notificationRequest->userId());
    }
}