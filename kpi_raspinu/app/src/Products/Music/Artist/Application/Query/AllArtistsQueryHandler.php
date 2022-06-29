<?php

namespace App\Products\Music\Artist\Application\Query;

use App\Products\Music\Artist\Domain\ArtistQueryRepository;
use App\Shared\Domain\ValueObjects\Paginated\Paginated;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedResponse;

class AllArtistsQueryHandler
{
    private ArtistQueryRepository $repository;

    public function __construct(ArtistQueryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(AllArtistsQuery $query): PaginatedResponse
    {
        $paginated = Paginated::create($query->page(), $query->pageSize());

        return $this->repository->AllArtists($paginated);
    }

}