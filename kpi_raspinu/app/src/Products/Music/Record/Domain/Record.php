<?php
namespace App\Products\Music\Record\Domain;

use App\Products\Music\Artist\Domain\ValueObjects\ArtistId;
use App\Products\Music\Record\Application\Services\UpdateRecordServiceCommand;
use App\Products\Music\Record\Domain\ValueObjects\RecordId;

final class Record
{
    private RecordId $id;
    private string $name;
    private ArtistId $artistId;


    public function __construct(RecordId $id,
                                string $name,
                                ArtistId $artistId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->artistId = $artistId;
    }


    public function id(): RecordId
    {
        return $this->id;
    }


    public function name(): string
    {
        return $this->name;
    }


    public function artistId(): ArtistId
    {
        return $this->artistId;
    }



    public function update (UpdateRecordServiceCommand $command): Record
    {
        $this->id = $command->id();
        $this->name =  $command->name();
        $this->artistId =  $command->artistId();

        return $this;
    }

}