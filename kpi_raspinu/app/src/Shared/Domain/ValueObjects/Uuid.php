<?php

namespace App\Shared\Domain\ValueObjects;

use Ramsey\Uuid\Uuid as RamseyUuid;
use App\Shared\Domain\ValueObjects\Exceptions\UuidValueException;

class Uuid
{
    private string $id;

    private final function __construct(string $id)
    {
        $this->id = $id;
    }

    /** @return static */
    public static function create(string $uuid)
    {
        if (!\Ramsey\Uuid\Nonstandard\Uuid::isValid($uuid)) {
            throw UuidValueException::notValid($uuid);
        }

        return new static($uuid);
    }

    public static function next(): string
    {
        return \Ramsey\Uuid\Nonstandard\Uuid::uuid4()->toString();
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function equals(self $uuid): bool
    {
        return $this->id === $uuid->id;
    }

    public static function random(): self
    {
        return new static(RamseyUuid::uuid4()->toString());
    }
}