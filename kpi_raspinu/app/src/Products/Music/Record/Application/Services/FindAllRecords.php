<?php

namespace App\Products\Music\Record\Application\Services;

use App\Products\Music\Record\Domain\RecordQueryRepository;
use App\Shared\Domain\ValueObjects\Paginated\Paginated;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedResponse;

class FindAllRecords
{
    private RecordQueryRepository $repository;


    public function __construct(RecordQueryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Paginated $paginated): PaginatedResponse
    {
        return  $this->repository->allRecords($paginated);
    }
}