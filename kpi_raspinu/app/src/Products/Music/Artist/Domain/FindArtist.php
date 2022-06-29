<?php

namespace App\Products\Music\Artist\Domain;

use App\Products\Music\Artist\Domain\ValueObjects\ArtistId;

final class FindArtist
{
    private ArtistQueryRepository $queryRepository;


    public function __construct(ArtistQueryRepository $queryRepository)
    {
        $this->queryRepository = $queryRepository;
    }

    public function __invoke(ArtistId $artistId): ?Artist
    {
        return $this->queryRepository->findOneBy($artistId);
    }

}