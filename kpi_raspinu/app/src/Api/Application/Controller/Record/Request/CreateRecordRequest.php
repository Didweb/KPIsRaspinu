<?php
namespace App\Api\Application\Controller\Record\Request;

use InvalidArgumentException;

final class CreateRecordRequest
{
    private string $id;
    private string $name;
    private string $artistId;


    public function __construct(string $id,
                                string $name,
                                string $artistId,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->artistId = $artistId;
    }


    public static function fromContent(array $content): self
    {
        $content = $content['record'][0];

        if (!isset($content['id'])
            || !isset($content['name'])
            || !isset($content['artistId'])
        ) {
            throw new InvalidArgumentException('Field id, name and artistId is required');
        }

        return new self (
            $content['id'],
            $content['name'],
            $content['artistId'],
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


    public function artistId(): string
    {
        return $this->artistId;
    }


}