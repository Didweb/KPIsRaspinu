<?php

namespace App\Products\Music\Artist\Application\Services;

use App\Products\Music\Artist\Domain\Artist;
use App\Products\Music\Artist\Domain\ArtistCommandRepository;

final class CreateArtist
{
    private ArtistCommandRepository $repository;

    public function __construct(ArtistCommandRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateArtistServiceCommand $dto): void
    {
        $artist = new Artist (
            $dto->id(),
            $dto->name()
        );

        $this->repository->create($artist);
    }
}