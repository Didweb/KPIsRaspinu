<?php

namespace App\Products\Music\Artist\Domain;

use App\Products\Music\Artist\Domain\ValueObjects\ArtistId;
use App\Shared\Domain\ValueObjects\Paginated\Paginated;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedResponse;

interface ArtistQueryRepository
{
    public function AllArtists(Paginated $paginated): PaginatedResponse;

    public function findOneBy(ArtistId $artistId);

    public function findOneByName(string $name);
}