<?php

namespace App\Products\Music\Record\Infrastructure\Response;

class RecordResponse
{
    private string $id;
    private string $name;
    private string $artistId;


    public function __construct(string $id, string $name, string $artistId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->artistId = $artistId;
    }


}