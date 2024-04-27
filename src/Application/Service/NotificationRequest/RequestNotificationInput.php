<?php

namespace App\Application\Service\NotificationRequest;

readonly class RequestNotificationInput
{
    public string $keyName;
    public string $messageBody;

    public function __construct(string $keyName, string $messageBody)
    {
        $this->keyName = $keyName;
        $this->messageBody = $messageBody;
    }
}