<?php

namespace App\Api\Application\Controller\Record\Request;

class UpdateRecordRequest
{

    private string $name;
    private string $artist_id;


    public function __construct(string $name, string $artist_id)
    {
        $this->name = $name;
        $this->artist_id = $artist_id;
    }

    public static function fromContent(array $content): self
    {
        $content = $content['record'][0];
        return new self(
            $content['name'],
            $content['artist_id'],
        );
    }


    public function name(): string
    {
        return $this->name;
    }


    public function artist_id(): string
    {
        return $this->artist_id;
    }


}