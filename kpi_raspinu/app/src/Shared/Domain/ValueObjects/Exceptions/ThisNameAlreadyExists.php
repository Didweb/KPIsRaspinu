<?php
namespace App\Shared\Domain\ValueObjects\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

final class ThisNameAlreadyExists extends HttpException
{

    public static function ofName(string $name): self
    {
        return new self(204,
            sprintf('The name <%s> already exists.', $name)
        );

    }

}