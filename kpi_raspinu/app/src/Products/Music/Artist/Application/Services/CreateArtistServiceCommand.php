<?php

namespace App\Products\Music\Artist\Application\Services;

use App\Products\Music\Artist\Domain\ValueObjects\ArtistId;

final class CreateArtistServiceCommand
{
    private ArtistId $id;
    private string $name;


    public function __construct(ArtistId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }


    public function id(): ArtistId
    {
        return $this->id;
    }


    public function name(): string
    {
        return $this->name;
    }


}