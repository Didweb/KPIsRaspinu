<?php

namespace App\Products\Music\Record\Infrastructure\Response;

use App\Products\Music\Record\Domain\Record;

final class RecordResponseConverter
{
    public function __invoke(Record $record): RecordResponse
    {
        return new RecordResponse(
            $record->id(),
            $record->name(),
            $record->artist_id()
        );
    }
}