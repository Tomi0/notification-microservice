<?php

namespace Tests\Notifications\Infrastructure\Doctrine\Domain\Model\DeliveryChannel;

use Notifications\Infrastructure\Doctrine\Domain\Models\DeliveryChannel\DeliveryChannelType;
use Tests\TestCase;

class DeliveryChannelTypeTest extends TestCase
{
    public function testGetName(): void
    {
        $deliveryChannelType = new DeliveryChannelType();
        $this->assertEquals('DeliveryChannelType', $deliveryChannelType->getName());
    }
}