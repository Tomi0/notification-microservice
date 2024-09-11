<?php

namespace Authentication\Application\Service\User;

use Authentication\Domain\Model\User\User;
use Authentication\Domain\Model\User\UserRepository;
use SharedKernel\Domain\Service\RandomStringGenerator;

class CreateUser
{
    private UserRepository $userRepository;
    private RandomStringGenerator $randomStringGenerator;

    public function __construct(UserRepository $userRepository,
                                RandomStringGenerator $randomStringGenerator)
    {
        $this->userRepository = $userRepository;
        $this->randomStringGenerator = $randomStringGenerator;
    }

    public function handle(CreateUserRequest $createUserRequest): User
    {
        $userId = $this->userRepository->nextId();
        $accessToken = $this->randomStringGenerator->execute();

        $user = new User($userId, $accessToken);

        $this->userRepository->persist($user);

        return $user;
    }
}