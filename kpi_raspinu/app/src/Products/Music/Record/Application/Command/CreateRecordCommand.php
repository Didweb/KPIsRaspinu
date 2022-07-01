<?php

namespace App\Products\Music\Record\Application\Command;

use App\Shared\Domain\Bus\Command\Command;

final class CreateRecordCommand extends Command
{
    private string $id;
    private string $name;
    private string $artist_id;


    public function __construct(string $id,
                                string $name,
                                string $artist_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->artist_id = $artist_id;
    }


    public function id(): string
    {
        return $this->id;
    }


    public function name(): string
    {
        return $this->name;
    }


    public function artist_id(): string
    {
        return $this->artist_id;
    }


    public function _toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'artist_id' => $this->artist_id,
        ];
    }

}