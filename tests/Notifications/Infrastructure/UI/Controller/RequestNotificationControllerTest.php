<?php

namespace Tests\Notifications\Infrastructure\UI\Controller;

use Notifications\Application\Service\NotificationRequest\RequestNotification;
use Notifications\Application\Service\NotificationRequest\RequestNotificationRequest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class RequestNotificationControllerTest extends WebTestCase
{
    public function testHealthCheckerController(): void
    {
        $client = static::createClient();
        $requestNotification = $this->createMock(RequestNotification::class);
        $requestNotification->expects($this->once())
            ->method('handle')
            ->with($this->callback(
                fn(RequestNotificationRequest $request) => $request->deliveryChannel === 'email'
                    && $request->to === 'testTo'
                    && $request->subject === 'testSubject'
                    && $request->content === 'testContent'
                    && $request->userId === 'uid'
            ));
        self::getContainer()->set(RequestNotification::class, $requestNotification);
        $client->request('POST', '/notification-request', [
            'deliveryChannel' => 'email',
            'to' => 'testTo',
            'subject' => 'testSubject',
            'content' => 'testContent',
            'userId' => 'uid'
        ]);
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);
    }
}