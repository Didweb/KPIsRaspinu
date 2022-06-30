<?php

namespace App\Products\Music\Artist\Infrastructure\Response;

use App\Products\Music\Artist\Domain\Artist;

final class ArtistResponseConverter
{
    public function __invoke(Artist $artist): ArtistResponse
    {
        return new ArtistResponse(
            $artist->id(),
            $artist->name()
        );
    }

}