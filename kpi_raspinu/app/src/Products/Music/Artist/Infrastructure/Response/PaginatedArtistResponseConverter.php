<?php

namespace App\Products\Music\Artist\Infrastructure\Response;

use App\Products\Music\Artist\Domain\Artist;
use App\Shared\Domain\ValueObjects\Paginated\Paginated;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedCollection;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedResponse;

class PaginatedArtistResponseConverter
{
    private ArtistResponseConverter $artistResponseConverter;


    public function __construct(ArtistResponseConverter $artistResponseConverter)
    {
        $this->artistResponseConverter = $artistResponseConverter;
    }

    public function __invoke(
                            PaginatedCollection $paginatedCollection,
                             Paginated $paginated): PaginatedResponse
    {
        $artist = $paginatedCollection->map(
            function (Artist $artist) {
                return $this->artistResponseConverter->__invoke($artist);
            }
        );

        return PaginatedResponse::create(
            $artist,
            $paginated->pageSize(),
            $paginatedCollection->totalCollection(),
            $paginatedCollection->total(),
            $paginated->page()

        );
    }
}