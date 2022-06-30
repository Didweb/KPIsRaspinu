<?php

namespace App\Products\Music\Artist\Infrastructure\Doctrine\Repository;

use App\Products\Music\Artist\Domain\Artist;
use App\Products\Music\Artist\Domain\ValueObjects\ArtistId;
use App\Products\Music\Artist\Domain\ArtistQueryRepository;
use App\Products\Music\Artist\Infrastructure\Response\ArtistResponseConverter;
use App\Products\Music\Artist\Infrastructure\Response\PaginatedArtistResponseConverter;
use App\Shared\Domain\ValueObjects\Paginated\Paginated;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedCollection;
use App\Shared\Domain\ValueObjects\Paginated\PaginatedResponse;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class DoctrineArtistQueryRepository implements ArtistQueryRepository
{

    private EntityManagerInterface $em;
    private ObjectRepository $repository;
    private ArtistResponseConverter $artistResponseConverter;
    private PaginatedArtistResponseConverter $paginatedArtistResponseConverter;

    public function __construct(
        EntityManagerInterface $manager,
        ArtistResponseConverter $artistResponseConverter,
        PaginatedArtistResponseConverter $paginatedArtistResponseConverter)
    {
        $this->em = $manager;
        $this->repository = $this->em->getRepository(Artist::class);
        $this->artistResponseConverter = $artistResponseConverter;
        $this->paginatedArtistResponseConverter = $paginatedArtistResponseConverter;
    }


    public function AllArtists(Paginated $paginated): PaginatedResponse
    {
        $totalArtist = $this->repository->findAll();
        $artists = $this->repository->findBy([],[],$paginated->pageSize(), $paginated->offset());

        $data = array_map(function($artists){
            return $this->repository->find($artists->id());
        }, $artists);

        return $this->paginatedArtistResponseConverter->__invoke(
            PaginatedCollection::createFromArray($data, count($totalArtist)),
            $paginated
        );
    }

    public function findOneBy(ArtistId $artistId): ?Artist
    {
        return $this->repository->findOneBy(['id' => $artistId]);
    }

    public function findOneByName(string $name): ?Artist
    {
        return $this->repository->findOneBy(['name' => $name]);
    }


}