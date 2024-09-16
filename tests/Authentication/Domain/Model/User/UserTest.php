<?php

namespace Tests\Authentication\Domain\Model\User;

use Authentication\Domain\Model\User\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    private User $user;
    private $idString;
    private $accessTokenString;

    protected function setUp(): void
    {
        parent::setUp();
        $this->idString = 'userId';
        $this->accessTokenString = 'accessToken';
        $this->user = new User($this->idString, $this->accessTokenString);
    }


    public function testIdReturnCorrectIdString(): void
    {
        $this->assertSame($this->idString, $this->user->id());
    }

    public function testIdReturnCorrectAccessTokenString(): void
    {
        $this->assertSame($this->accessTokenString, $this->user->accessToken());
    }

    public function testCreatedAtIsADateTimeObject(): void
    {
        $this->assertInstanceOf(\DateTime::class, $this->user->createdAt());
    }

    public function testUpdatedAtIsADateTimeObject(): void
    {
        $this->assertInstanceOf(\DateTime::class, $this->user->updatedAt());
    }

    public function testCreatedAtIsACurrentTimestamp():void
    {
        $this->assertEquals(time(), $this->user->createdAt()->getTimestamp());
    }

    public function testUpdatedAtIsACurrentTimestamp():void
    {
        $this->assertEquals(time(), $this->user->updatedAt()->getTimestamp());
    }
}