<?php

namespace App\Products\Music\Record\Domain\Exceptions;

use App\Products\Music\Record\Domain\ValueObjects\RecordId;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RecordExistException  extends HttpException
{
    public static function checkByRecordId(RecordId $recordId): self
    {
        return new self(204,
            sprintf('Item with RecordId: <%s> It already exists.', (string)$recordId)
        );

    }
}