<?php

namespace App\Products\Music\Artist\Infrastructure\Response;

class ArtistResponse
{
    private string $id;
    private string $name;


    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

}