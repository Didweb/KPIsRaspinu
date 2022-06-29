<?php

namespace App\Api\Application\Controller\Artist\Request;

use InvalidArgumentException;

class CreateArtistRequest
{
    private string $id;
    private string $name;


    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }


    public static function fromContent(array $content): self
    {
        $content = $content['artist'][0];

        if (!isset($content['id'])
            || !isset($content['name'])) {
            throw new InvalidArgumentException('Field id and name is required');
        }

        return new self (
            $content['id'],
            $content['name'],
        );
    }


    public function id(): string
    {
        return $this->id;
    }


    public function name(): string
    {
        return $this->name;
    }

}