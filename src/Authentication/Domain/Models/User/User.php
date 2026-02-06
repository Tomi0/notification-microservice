<?php

namespace Authentication\Domain\Models\User;

use SharedKernel\Domain\Models\Entity;

class User implements Entity
{
    private UserId $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private ?string $phone;
    private string $password;
    private bool $active;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    public function __construct(UserId $id,
        string $firstName,
        string $lastName,
        string $email,
        ?string $phone,
        string $password)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->active = true;
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function phone(): ?string
    {
        return $this->phone;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function active(): bool
    {
        return $this->active;
    }

    public function createdAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function updatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}
