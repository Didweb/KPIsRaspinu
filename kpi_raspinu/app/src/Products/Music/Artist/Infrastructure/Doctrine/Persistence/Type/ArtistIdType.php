<?php

namespace App\Products\Music\Artist\Infrastructure\Doctrine\Persistence\Type;

use App\Products\Music\Artist\Domain\ValueObjects\ArtistId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class ArtistIdType extends StringType
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

        return ArtistId::create($value);
    }
}