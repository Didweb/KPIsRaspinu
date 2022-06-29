<?php

namespace App\Products\Music\Artist\Application\Services;

use App\Products\Music\Artist\Domain\ArtistQueryRepository;
use App\Shared\Domain\ValueObjects\Paginated\Paginated;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedResponse;

class FindAllArtist
{
    private ArtistQueryRepository $repository;


    public function __construct(ArtistQueryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Paginated $paginated): PaginatedResponse
    {
        return $this->repository->allArtists($paginated);
    }

}