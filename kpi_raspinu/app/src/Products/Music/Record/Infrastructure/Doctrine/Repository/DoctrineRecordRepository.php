<?php

namespace App\Products\Music\Record\Infrastructure\Doctrine\Repository;


use App\Products\Music\Record\Domain\Record;
use App\Products\Music\Record\Domain\RecordQueryRepository;
use App\Products\Music\Record\Domain\ValueObjects\RecordId;
use App\Products\Music\Record\Infrastructure\Response\PaginatedRecordResponseConverter;
use App\Shared\Domain\ValueObjects\Paginated\Paginated;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedCollection;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;


class DoctrineRecordRepository implements RecordQueryRepository
{
    private EntityManagerInterface $em;
    private ObjectRepository $repository;
    private RecordResponseConverter $recordResponseConverter;
    private PaginatedRecordResponseConverter $paginatedRecordResponseConverter;


    public function __construct(
        EntityManagerInterface $manager,
        RecordResponseConverter $recordResponseConverter,
        PaginatedRecordResponseConverter $paginatedRecordResponseConverter
    )
    {
        $this->em = $manager;
        $this->repository = $this->em->getRepository(Record::class);
        $this->recordResponseConverter = $recordResponseConverter;
        $this->paginatedRecordResponseConverter = $paginatedRecordResponseConverter;
    }


    public function AllRecords(Paginated $paginated): PaginatedResponse
    {

        $totalRecords = $this->repository->findAll();
        $records = $this->repository->findBy([],[],$paginated->pageSize(), $paginated->offset());

        $data = array_map(function(  $records) {
            return $this->repository->find($records->id());
        }, $records);

        return $this->paginatedRecordResponseConverter->__invoke(
            PaginatedCollection::createFromArray($data, count($totalRecords)),
            $paginated
        );
    }

    public function findOneBy(RecordId $recordId): ?Record
    {
        return $this->repository->findOneBy(['id' => $recordId]);
    }


}