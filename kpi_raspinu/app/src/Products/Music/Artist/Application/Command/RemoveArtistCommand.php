<?php

namespace App\Products\Music\Artist\Application\Command;

use App\Shared\Domain\Bus\Command\Command;

class RemoveArtistCommand extends Command
{
    private string $id;


    public function __construct(string $id)
    {
        $this->id = $id;
    }


    public function id(): string
    {
        return $this->id;
    }

    public function _toArray(): array
    {
        return [
            'id' => $this->id
        ];
    }
}