<?php

namespace App\Products\Music\Artist\Domain;

interface ArtistCommandRepository
{
    public function create(Artist $record): void;
}