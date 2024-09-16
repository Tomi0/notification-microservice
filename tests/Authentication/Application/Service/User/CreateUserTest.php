<?php

namespace Tests\Authentication\Application\Service\User;

use Authentication\Application\Service\User\CreateUser;
use Authentication\Application\Service\User\CreateUserRequest;
use Authentication\Domain\Model\User\User;
use Authentication\Domain\Model\User\UserRepository;
use SharedKernel\Domain\Service\RandomStringGenerator;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    private CreateUser $createUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createUser = self::getContainer()->get(CreateUser::class);
    }

    public function testReturnIsAUser(): void
    {
        $user = $this->createUser->handle(new CreateUserRequest());

        $this->assertInstanceOf(User::class, $user);
    }

    public function testCallGenerateRandomStringServiceForTheAccessToken(): void
    {
        $randomString = 'randomString';

        $userRepository = self::getContainer()->get(UserRepository::class);
        $randomStringGeneratorMock = $this->createMock(RandomStringGenerator::class);
        $randomStringGeneratorMock->expects($this->once())
            ->method('execute')
            ->willReturn($randomString);

        $user = (new CreateUser(
            $userRepository,
            $randomStringGeneratorMock))
            ->handle(new CreateUserRequest());

        $this->assertSame($randomString, $user->accessToken());
    }

}