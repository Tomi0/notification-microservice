<?php

namespace Tests\Notifications\Domain\Model\NotificationRequest;

use Notifications\Domain\Model\DeliveryChannel\DeliveryChannel;
use Notifications\Domain\Model\NotificationRequest\NotificationRequest;
use Tests\TestCase;

class NotificationRequestTest extends TestCase
{
    private string $id;
    private DeliveryChannel $deliveryChannel;
    private string $to;
    private string $subject;
    private string $content;
    private string $userId;
    private NotificationRequest $notificationRequest;

    protected function setUp(): void
    {
        parent::setUp();
        $this->id = 'testId';
        $this->deliveryChannel = DeliveryChannel::EMAIL;
        $this->to = 'testTo';
        $this->subject = 'testSubject';
        $this->content = 'testContent';
        $this->userId = 'testUserId';
        $this->notificationRequest = new NotificationRequest(
            $this->id,
            $this->deliveryChannel,
            $this->to,
            $this->subject,
            $this->content,
            $this->userId,
        );
    }

    public function testGetId(): void
    {
        $this->assertEquals($this->id, $this->notificationRequest->id());
    }

    public function testGetDeliveryChannel(): void
    {
        $this->assertEquals($this->deliveryChannel, $this->notificationRequest->deliveryChannel());
    }

    public function testGetTo(): void
    {
        $this->assertEquals($this->to, $this->notificationRequest->to());
    }

    public function testGetSubject(): void
    {
        $this->assertEquals($this->subject, $this->notificationRequest->subject());
    }

    public function testGetContent(): void
    {
        $this->assertEquals($this->content, $this->notificationRequest->content());
    }

    public function testGetUserId(): void
    {
        $this->assertEquals($this->userId, $this->notificationRequest->userId());
    }

    public function testGetCreatedAt(): void
    {
        $this->assertInstanceOf(\DateTime::class, $this->notificationRequest->createdAt());
    }

    public function testGetUpdatedAt(): void
    {
        $this->assertInstanceOf(\DateTime::class, $this->notificationRequest->updatedAt());
    }

}