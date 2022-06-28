<?php

namespace App\Products\Music\Record\Infrastructure\Response;

use App\Products\Music\Record\Domain\Record;
use App\Shared\Domain\ValueObjects\Paginated\Paginated;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedResponse;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedCollection;

class PaginatedRecordResponseConverter
{

    private RecordResponseConverter $recordResponseConverter;


    public function __construct(RecordResponseConverter $recordResponseConverter)
    {
        $this->recordResponseConverter = $recordResponseConverter;
    }

    public function __invoke(PaginatedCollection $paginatedCollection, Paginated $paginated): PaginatedResponse
    {
        $record = $paginatedCollection->map(
            function (Record $record) {
                return $this->recordResponseConverter->__invoke($record);
            }
        );

        return PaginatedResponse::create(
            $record,
            $paginated->pageSize(),
            $paginatedCollection->totalCollection(),
            $paginatedCollection->total(),
            $paginated->page()

        );
    }
}