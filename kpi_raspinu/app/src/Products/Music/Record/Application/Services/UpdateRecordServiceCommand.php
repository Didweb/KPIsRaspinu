<?php

namespace App\Products\Music\Record\Application\Services;

use App\Products\Music\Artist\Domain\ValueObjects\ArtistId;
use App\Products\Music\Record\Domain\ValueObjects\RecordId;

final class UpdateRecordServiceCommand
{
    private RecordId $id;
    private string $name;
    private ArtistId $artist_id;


    public function __construct(RecordId $id,
                                string   $name,
                                ArtistId $artist_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->artist_id = $artist_id;
    }


    public function id(): RecordId
    {
        return $this->id;
    }


    public function name(): string
    {
        return $this->name;
    }


    public function artist_id(): ArtistId
    {
        return $this->artist_id;
    }



}