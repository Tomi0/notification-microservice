<?php

namespace Notifications\Domain\Model\NotificationRequest;

interface NotificationRequestRepository
{

    public function nextId(): string;

    public function persist(NotificationRequest $notificationRequest): void;
}