<?php

namespace Notifications\Infrastructure\Doctrine\Domain\Models\DeliveryChannel;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;
use Notifications\Domain\Model\DeliveryChannel\DeliveryChannel;

class DeliveryChannelType extends StringType
{
    public function getName(): string
    {
        return 'DeliveryChannelType';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): DeliveryChannel
    {
        return DeliveryChannel::from($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value->value;
    }
}