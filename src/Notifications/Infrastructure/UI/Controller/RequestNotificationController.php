<?php

namespace Notifications\Infrastructure\UI\Controller;

use Notifications\Application\Service\NotificationRequest\RequestNotification;
use Notifications\Application\Service\NotificationRequest\RequestNotificationRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestNotificationController extends AbstractController
{
    private RequestNotification $requestNotification;

    public function __construct(RequestNotification $requestNotification)
    {
        $this->requestNotification = $requestNotification;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $notificationRequest = $this->requestNotification->handle(
            new RequestNotificationRequest(
                $request->get('deliveryChannel'),
                $request->get('to'),
                $request->get('subject'),
                $request->get('content'),
                $request->get('userId')
            )
        );
        return $this->json(
            $notificationRequest->id(),
            Response::HTTP_CREATED
        );
    }
}