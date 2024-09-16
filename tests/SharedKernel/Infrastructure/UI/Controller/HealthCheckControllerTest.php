<?php

namespace Tests\SharedKernel\Infrastructure\UI\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthCheckControllerTest extends WebTestCase
{
    public function testHealthCheckerController(): void
    {
        $client = static::createClient();
        $client->request('GET', '/health-check');
        $this->assertResponseIsSuccessful();
        $this->assertJsonStringEqualsJsonString('{"status":"ok"}', $client->getResponse()->getContent());
    }
}