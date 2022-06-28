<?php

namespace App\Products\Music\Record\Domain;

use App\Products\Music\Record\Domain\ValueObjects\RecordId;
use HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class RecordFinder
{
    private RecordQueryRepository $queryRepository;


    public function __construct(RecordQueryRepository $queryRepository)
    {
        $this->queryRepository = $queryRepository;
    }

    public function __invoke(RecordId $recordId): Record
    {
        $record = $this->queryRepository->findOneBy($recordId);

        if (null == $record) {
            throw new HttpException('Record with id: <%s> not found', (string)$recordId);
        }

        return $record;

    }

}