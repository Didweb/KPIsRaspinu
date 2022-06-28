<?php

namespace App\Products\Music\Record\Domain;

use App\Products\Music\Record\Domain\ValueObjects\RecordId;
use App\Shared\Domain\ValueObjects\Paginated\Paginated;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedResponse;

interface RecordQueryRepository
{
    public function AllRecords(Paginated $paginated): PaginatedResponse;

    public function findOneBy(RecordId $recordId): ?Record;
}