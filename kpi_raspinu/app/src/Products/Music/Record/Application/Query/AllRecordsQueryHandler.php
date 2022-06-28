<?php

namespace App\Products\Music\Record\Application\Query;


use App\Products\Music\Record\Domain\RecordQueryRepository;
use App\Shared\Domain\ValueObjects\Paginated\Paginated;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedResponse;

final class AllRecordsQueryHandler
{
    private RecordQueryRepository $repository;


    public function __construct(RecordQueryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(AllRecordsQuery $query): PaginatedResponse
    {
        $paginated = Paginated::create($query->page(), $query->pageSize());

        return $this->repository->AllRecords($paginated);
    }

}