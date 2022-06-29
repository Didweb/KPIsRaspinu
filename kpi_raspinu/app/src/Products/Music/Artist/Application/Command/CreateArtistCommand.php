<?php

namespace App\Products\Music\Artist\Application\Command;

use App\Shared\Domain\Bus\Command\Command;

final class CreateArtistCommand extends Command
{
    private string $id;
    private string $name;


    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }


    public function id(): string
    {
        return $this->id;
    }


    public function name(): string
    {
        return $this->name;
    }

    public function _toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}