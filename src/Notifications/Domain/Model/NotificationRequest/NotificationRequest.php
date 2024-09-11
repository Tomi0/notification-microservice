<?php

namespace Notifications\Domain\Model\NotificationRequest;

use DateTime;
use Notifications\Domain\Model\DeliveryChannel\DeliveryChannel;

class NotificationRequest
{
    private string $id;
    private DeliveryChannel $deliveryChannel;
    private string $to;
    private ?string $subject;
    private string $content;
    private string $userId;

    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(string $id, DeliveryChannel $deliveryChannel, string $to, ?string $subject, string $content, string $userId)
    {
        $this->id = $id;
        $this->deliveryChannel = $deliveryChannel;
        $this->to = $to;
        $this->subject = $subject;
        $this->content = $content;
        $this->userId = $userId;

        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function subject(): ?string
    {
        return $this->subject;
    }


    public function content(): string
    {
        return $this->content;
    }

    public function deliveryChannel(): DeliveryChannel
    {
        return $this->deliveryChannel;
    }

    public function to(): string
    {
        return $this->to;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function createdAt(): DateTime
    {
        return $this->createdAt;
    }

    public function updatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}
