<?php

namespace Authentication\Domain\Models\User;

use SharedKernel\Domain\Models\ValueObject;

class UserId implements ValueObject
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function __toString(): string
    {
        return $this->value();
    }

    public function isEqual(ValueObject $valueObject): bool
    {
        return $this->value() === $valueObject->value();
    }

    public function value(): string
    {
        return $this->id;
    }
}
