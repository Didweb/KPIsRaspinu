<?php

namespace App\Products\Music\Artist\Infrastructure\Doctrine\Repository;

use App\Products\Music\Artist\Application\Command\RemoveArtistCommand;
use App\Products\Music\Artist\Domain\Artist;
use App\Products\Music\Artist\Domain\ArtistCommandRepository;
use App\Products\Music\Artist\Domain\ArtistQueryRepository;
use App\Products\Music\Artist\Domain\ValueObjects\ArtistId;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class DoctrineArtistCommandRepository implements ArtistCommandRepository
{
    private EntityManagerInterface $em;
    private ArtistQueryRepository $repositoryQuery;

    public function __construct(EntityManagerInterface $em,
                                ArtistQueryRepository $repositoryQuery)
    {
        $this->em = $em;
        $this->repositoryQuery = $repositoryQuery;
    }


    public function create(Artist $artist): void
    {
        $this->em->persist($artist);
        $this->em->flush($artist);
    }

    public function remove(RemoveArtistCommand $command): void
    {
        $artistId = ArtistId::create($command->id());

        $artist = $this->repositoryQuery->findOneBy($artistId);

        if(null === $artist) {
            throw new Exception('ArtistId: '.$artistId.' Not Exist');
        }

        $this->em->remove($artist);
        $this->em->flush();
    }
}