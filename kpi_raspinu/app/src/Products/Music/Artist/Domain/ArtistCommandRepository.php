<?php

namespace App\Products\Music\Artist\Domain;

use App\Products\Music\Artist\Application\Command\RemoveArtistCommand;

interface ArtistCommandRepository
{
    public function create(Artist $artist): void;

    public function remove(RemoveArtistCommand $record): void;
}