<?php

namespace Notifications\Application\Service\NotificationRequest;

readonly class RequestNotificationRequest
{
    public function __construct(
        public string $deliveryChannel,
        public string $to,
        public string $subject,
        public string $content,
        public string $userId
    )
    {
    }
}