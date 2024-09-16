<?php

namespace Notifications\Application\Service\NotificationRequest;

use Notifications\Domain\Model\DeliveryChannel\DeliveryChannel;
use Notifications\Domain\Model\NotificationRequest\NotificationRequest;
use Notifications\Domain\Model\NotificationRequest\NotificationRequestRepository;

class RequestNotification
{
    private NotificationRequestRepository $notificationRequestRepository;

    public function __construct(NotificationRequestRepository $notificationRequestRepository)
    {
        $this->notificationRequestRepository = $notificationRequestRepository;
    }

    public function handle(RequestNotificationRequest $requestNotificationRequest): NotificationRequest
    {
        $nextId = $this->notificationRequestRepository->nextId();

        $notificationRequest = new NotificationRequest(
            $nextId,
            DeliveryChannel::from($requestNotificationRequest->deliveryChannel),
            $requestNotificationRequest->to,
            $requestNotificationRequest->subject,
            $requestNotificationRequest->content,
            $requestNotificationRequest->userId
        );

        $this->notificationRequestRepository->persist($notificationRequest);

        return $notificationRequest;
    }
}