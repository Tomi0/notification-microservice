<?php

namespace SharedKernel\Domain\Models;

interface ValueObject
{
    public function __toString(): string;

    public function isEqual(ValueObject $valueObject): bool;

    public function value(): mixed;
}
