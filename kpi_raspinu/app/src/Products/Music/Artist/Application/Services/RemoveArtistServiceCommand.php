<?php

namespace App\Products\Music\Artist\Application\Services;

use App\Products\Music\Artist\Application\Command\RemoveArtistCommand;
use App\Products\Music\Artist\Domain\ArtistCommandRepository;

class RemoveArtistServiceCommand
{
    private ArtistCommandRepository $artistCommandRepository;


    public function __construct(ArtistCommandRepository $artistCommandRepository)
    {
        $this->artistCommandRepository = $artistCommandRepository;
    }

    public function __invoke(RemoveArtistCommand $command)
    {

        $this->artistCommandRepository->remove($command);
    }
}