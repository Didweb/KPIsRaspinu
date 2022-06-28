<?php

namespace App\Products\Music\Record\Application\Services;

use App\Products\Music\Record\Domain\ValueObjects\RecordId;

class CreateRecordServiceCommand
{
    private RecordId $id;
    private string $name;


    public function __construct(RecordId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }


    public function id(): RecordId
    {
        return $this->id;
    }


    public function name(): string
    {
        return $this->name;
    }


}