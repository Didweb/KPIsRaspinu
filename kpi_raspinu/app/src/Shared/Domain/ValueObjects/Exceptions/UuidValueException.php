<?php

namespace App\Shared\Domain\ValueObjects\Exceptions;

use Exception;

final class UuidValueException extends Exception
{
    public static function notValid(string $uuid): self
    {
        return new self(
            sprintf('The uuid provided does not contain a valid value: <%s>', $uuid)
        );
    }
}