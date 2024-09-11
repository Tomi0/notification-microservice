<?php

namespace Notifications\Infrastructure\Doctrine\Domain\Models\NotificationRequest;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Notifications\Domain\Model\NotificationRequest\NotificationRequest;
use Notifications\Domain\Model\NotificationRequest\NotificationRequestRepository;

class NotificationRequestDoctrineRepository extends ServiceEntityRepository implements NotificationRequestRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotificationRequest::class);
    }
}
