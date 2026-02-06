<?php

namespace Authentication\Infrastructure\Doctrine\Domain\Models\User;

use Authentication\Domain\Models\User\UserId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use SharedKernel\Domain\Models\ValueObject;

// TODO Possible refactor: many functions could be extracted to a parent class
class UserIdType extends Type
{
    public const NAME = 'user_id';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getStringTypeDeclarationSQL($column);
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): UserId
    {
        return new UserId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): mixed
    {
        if ($value instanceof ValueObject) {
            return $value->value();
        }

        return $value;
    }
}
