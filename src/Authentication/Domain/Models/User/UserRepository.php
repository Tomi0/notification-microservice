<?php

namespace Authentication\Domain\Models\User;

interface UserRepository
{
    /**
     * @return User[]
     */
    public function search(): array;
}
