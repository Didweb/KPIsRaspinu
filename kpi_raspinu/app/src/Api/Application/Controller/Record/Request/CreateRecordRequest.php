<?php
namespace App\Api\Application\Controller\Record\Request;

use InvalidArgumentException;

final class CreateRecordRequest
{
    private string $id;
    private string $name;
    private string $artist_id;


    public function __construct(string $id,
                                string $name,
                                string $artist_id,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->artist_id = $artist_id;
    }


    public static function fromContent(array $content): self
    {
        $content = $content['record'][0];

        if (!isset($content['id'])
            || !isset($content['name'])
            || !isset($content['artist_id'])
        ) {
            throw new InvalidArgumentException('Field id, name and artist_id is required');
        }

        return new self (
            $content['id'],
            $content['name'],
            $content['artist_id'],
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


    public function artist_id(): string
    {
        return $this->artist_id;
    }


}