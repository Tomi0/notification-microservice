<?php

namespace Authentication\Domain\Model\User;

use DateTime;

class User
{
    private string $id;
    private string $accessToken;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(string $id, string $accessToken)
    {
        $this->id = $id;
        $this->accessToken = $accessToken;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function accessToken(): string
    {
        return $this->accessToken;
    }
    
    public function createdAt(): DateTime
    {
        return $this->createdAt;
    }
    
    public function updatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}