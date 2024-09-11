<?php

namespace SharedKernel\Domain\Service;

interface RandomStringGenerator
{
    public function execute(): string;
}