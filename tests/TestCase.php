<?php

namespace Tests;

use Doctrine\Persistence\ObjectManager;
use Exception;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestCase extends WebTestCase
{
    private static ?ObjectManager $em = null;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        if (self::$em === null) {
            self::$em = static::getContainer()->get('doctrine')->getManager();
        }
    }

    /**
     * @param array<string> $fixturesClassNames
     */
    protected function loadFixtures(array $fixturesClassNames): void
    {
        foreach ($fixturesClassNames as $fixturesClassName) {
            $fixture = new $fixturesClassName();
            $fixture->load(self::$em);
        }
    }

    protected function getDependency(string $class): mixed
    {
        return static::getContainer()->get($class);
    }
}