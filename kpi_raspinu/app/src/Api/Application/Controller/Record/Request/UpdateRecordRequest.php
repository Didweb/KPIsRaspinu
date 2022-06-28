<?php

namespace App\Api\Application\Controller\Record\Request;

class UpdateRecordRequest
{

    private string $name;


    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function fromContent(array $content): self
    {
        $content = $content['record'][0];
        return new self(
            $content['name']
        );
    }


    public function name(): string
    {
        return $this->name;
    }


}