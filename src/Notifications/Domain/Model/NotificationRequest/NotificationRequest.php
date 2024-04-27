<?php

namespace Notifications\Domain\Model\NotificationRequest;

use DateTime;

class NotificationRequest
{
    private string $id;
    private string $keyName;
    private string $messageBody;
    private DateTime $occurredOn;

    public function __construct(string $id, string $keyName, string $messageBody)
    {
        $this->id = $id;
        $this->keyName = $keyName;
        $this->messageBody = $messageBody;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function keyName(): string
    {
        return $this->keyName;
    }


    public function messageBody(): string
    {
        return $this->messageBody;
    }

    public function occurredOn(): DateTime
    {
        return $this->occurredOn;
    }
}
