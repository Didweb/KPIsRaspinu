<?php

namespace App\Products\Music\Record\Infrastructure\Response;

class RecordResponse
{
    private string $id;
    private string $name;


    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }


}