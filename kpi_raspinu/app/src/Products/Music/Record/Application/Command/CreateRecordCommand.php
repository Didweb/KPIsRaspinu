<?php

namespace App\Products\Music\Record\Application\Command;

use App\Shared\Domain\Bus\Command\Command;

final class CreateRecordCommand extends Command
{
    private string $id;
    private string $name;
    private string $artistId;


    public function __construct(string $id,
                                string $name,
                                string $artistId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->artistId = $artistId;
    }


    public function id(): string
    {
        return $this->id;
    }


    public function name(): string
    {
        return $this->name;
    }


    public function artistId(): string
    {
        return $this->artistId;
    }


    public function _toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'artistId' => $this->artistId,
        ];
    }

}