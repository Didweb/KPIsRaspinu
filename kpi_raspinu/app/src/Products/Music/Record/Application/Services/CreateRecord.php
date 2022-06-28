<?php

namespace App\Products\Music\Record\Application\Services;

use App\Products\Music\Record\Domain\Record;
use App\Products\Music\Record\Domain\RecordCommandRepository;

final class CreateRecord
{
    private RecordCommandRepository $repository;

    public function __construct(RecordCommandRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CreateRecordServiceCommand $dto): void
    {
        $record = new Record (
            $dto->id(),
            $dto->name()
        );

        $this->repository->create($record);
    }
}