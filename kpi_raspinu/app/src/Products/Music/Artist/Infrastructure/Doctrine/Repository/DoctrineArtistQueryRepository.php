<?php

namespace App\Products\Music\Artist\Infrastructure\Doctrine\Repository;

use App\Products\Music\Artist\Domain\Artist;
use App\Products\Music\Artist\Domain\ArtistQueryRepository;
use App\Products\Music\Record\Infrastructure\Response\PaginatedRecordResponseConverter;
use App\Shared\Domain\ValueObjects\Paginated\Paginated;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedCollection;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrineArtistQueryRepository implements ArtistQueryRepository
{

    private EntityManagerInterface $em;
    private ObjectRepository $repository;
    private PaginatedRecordResponseConverter $paginatedRecordResponseConverter;

    public function __construct(
        EntityManagerInterface $manager,
        PaginatedRecordResponseConverter $paginatedRecordResponseConverter)
    {
        $this->em = $manager;
        $this->repository = $this->em->getRepository(Artist::class);
        $this->paginatedRecordResponseConverter = $paginatedRecordResponseConverter;
    }


    public function AllArtists(Paginated $paginated): PaginatedResponse
    {
        $totalArtist = $this->repository->findAll();
        $artists = $this->repository->findBy([],[],$paginated->pageSize(), $paginated->offset());

        $data = array_map(function($artists){
            return $this->repository->find($artists->id());
        }, $artists);

        return $this->paginatedRecordResponseConverter->__invoke(
            PaginatedCollection::createFromArray($data, count($totalArtist)),
            $paginated
        );
    }
}