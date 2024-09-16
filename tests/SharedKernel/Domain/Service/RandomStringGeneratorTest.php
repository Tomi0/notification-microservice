<?php

namespace Tests\SharedKernel\Domain\Service;

use SharedKernel\Domain\Service\RandomStringGenerator;
use Tests\TestCase;

class RandomStringGeneratorTest extends TestCase
{
    private RandomStringGenerator $randomStringGenerator;

    protected function setUp(): void
    {
        parent::setUp();
        $container = self::getContainer();
        $this->randomStringGenerator = $container->get(RandomStringGenerator::class);
    }

    public function testReturnString()
    {
        $result = $this->randomStringGenerator->execute();

        $this->assertIsString($result);
    }

    public function testStringHaveAtLeast16Characters()
    {
        $result = $this->randomStringGenerator->execute();

        $this->assertGreaterThan(16, strlen($result));
    }

    public function testReturnValueIsRandom(): void
    {
        $returnValues = [];

        $numberOfStrings = 500;

        for ($i = 0; $i < $numberOfStrings; $i++) {
            $returnValues[] = $this->randomStringGenerator->execute();
        }

        $uniqueValues = array_unique($returnValues);

        $this->assertEquals(
            $numberOfStrings,
            count($uniqueValues)
        );
    }
}