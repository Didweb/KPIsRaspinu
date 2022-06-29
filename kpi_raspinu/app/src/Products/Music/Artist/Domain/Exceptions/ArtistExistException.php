<?php

namespace App\Products\Music\Artist\Domain\Exceptions;

use App\Products\Music\Artist\Domain\ValueObjects\ArtistId;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ArtistExistException  extends HttpException
{
    public static function checkByRecordId(ArtistId $artistId): self
    {
        return new self(204,
            sprintf('Item with ArtistId: <%s> It already exists.', (string)$artistId)
        );

    }
}