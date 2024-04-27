<?php

namespace Notifications\Application\Service\NotificationRequest;

class RequestNotification
{

    public function __construct()
    {
    }

    public function handle(RequestNotificationInput $requestNotificationInput): string
    {
        return "Notification request handled";
    }
}