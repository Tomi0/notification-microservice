<?php

namespace Authentication\Domain\Model\User;

interface UserRepository
{

    public function nextId(): string;

    public function persist(User $user): void;
}