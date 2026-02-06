<?php

namespace Tests\Authentication\Application\Services\User;

use Authentication\Application\Services\User\SearchUsers;
use Authentication\Domain\Models\User\User;
use Tests\Fixtures\UserFixture;
use Tests\TestCase;

class SearchUsersTest extends TestCase
{
    private SearchUsers $searchUsers;

    protected function setUp(): void
    {
        parent::setUp();
        $this->searchUsers = $this->getDependency(SearchUsers::class);
        $this->initTestData();
    }

    private function initTestData(): void
    {
        $this->loadFixtures([
            UserFixture::class,
        ]);
    }

    public function testReturnArrayOfUserEntity(): void
    {
        $result = $this->searchUsers->handle();
        $this->assertCount(1, $result);
        $this->assertInstanceOf(User::class, $result[0]);
    }
}