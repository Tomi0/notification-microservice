<?php

namespace Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TestCase extends KernelTestCase
{
    protected function setUp(): void
    {
        self::bootKernel([
            'debug'       => false,
        ]);
    }
}