<?php

namespace Tests\Fixtures;

use Authentication\Domain\Models\User\User;
use Authentication\Domain\Models\User\UserId;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class UserFixture extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $user = new User(
            new UserId(Uuid::uuid4()->toString()),
            'Tom',
            'Last Name',
            'email@test.com',
            '+34 666444555',
            'password',
        );

        $manager->persist($user);
        $manager->flush();
    }
}