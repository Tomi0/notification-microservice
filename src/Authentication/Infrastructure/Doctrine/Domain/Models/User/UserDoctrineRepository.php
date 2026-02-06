<?php

namespace Authentication\Infrastructure\Doctrine\Domain\Models\User;

use Authentication\Domain\Models\User\User;
use Authentication\Domain\Models\User\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserDoctrineRepository extends ServiceEntityRepository implements UserRepository
{
    private string $modelClass = User::class;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, $this->modelClass);
    }

    public function search(): array
    {
        return $this->getEntityManager()->createQuery(<<<DQL
                SELECT u
                FROM $this->modelClass u
                WHERE u.active = true
            DQL)
            ->setMaxResults(50)
            ->getResult();
    }
}
