<?php

namespace SharedKernel\Infrastructure\Ramsey\Domain\Service;

use Ramsey\Uuid\Uuid;
use SharedKernel\Domain\Service\RandomStringGenerator;

class RandomStringGeneratorRamsey implements RandomStringGenerator
{

    public function execute(): string
    {
        return Uuid::uuid4()->toString();
    }
}