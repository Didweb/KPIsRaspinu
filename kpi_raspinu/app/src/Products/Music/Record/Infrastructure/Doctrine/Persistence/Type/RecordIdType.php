<?php

namespace App\Products\Music\Record\Infrastructure\Doctrine\Persistence\Type;

use App\Products\Music\Record\Domain\ValueObjects\RecordId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class RecordIdType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!$value) {
            return null;
        }
        return (string) $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (!$value) {
            return null;
        }

        return RecordId::create($value);
    }
}