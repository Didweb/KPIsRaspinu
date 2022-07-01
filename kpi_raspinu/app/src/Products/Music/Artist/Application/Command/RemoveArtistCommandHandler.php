<?php

namespace App\Products\Music\Artist\Application\Command;

class RemoveArtistCommandHandler
{
    private RemoveArtistServiceCommand $removeArtistServiceCommand;

    public function __construct(RemoveArtistServiceCommand $removeArtistServiceCommand)
    {
        $this->removeArtistServiceCommand = $removeArtistServiceCommand;
    }

    public function __invoke(RemoveArtistCommand $command): void
    {
        $this->removeArtistServiceCommand->__invoke($command);
    }

}