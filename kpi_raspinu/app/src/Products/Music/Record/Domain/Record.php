<?php
namespace App\Products\Music\Record\Domain;

use App\Products\Music\Record\Application\Services\UpdateRecordServiceCommand;
use App\Products\Music\Record\Domain\ValueObjects\RecordId;

final class Record
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

    public function update (UpdateRecordServiceCommand $command): Record
    {
        $this->id = $command->id();
        $this->name =  $command->name();

        return $this;
    }

}