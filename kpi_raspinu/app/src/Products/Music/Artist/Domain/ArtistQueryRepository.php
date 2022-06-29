<?php

namespace App\Products\Music\Artist\Domain;

use App\Shared\Domain\ValueObjects\Paginated\Paginated;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedResponse;

interface ArtistQueryRepository
{
    public function AllArtists(Paginated $paginated): PaginatedResponse;
}