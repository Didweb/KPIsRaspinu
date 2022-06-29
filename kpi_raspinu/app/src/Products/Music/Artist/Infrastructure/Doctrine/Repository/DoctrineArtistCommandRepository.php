<?php

namespace App\Products\Music\Artist\Infrastructure\Doctrine\Repository;

use App\Products\Music\Artist\Domain\Artist;
use App\Products\Music\Artist\Domain\ArtistCommandRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineArtistCommandRepository implements ArtistCommandRepository
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function create(Artist $record): void
    {
        $this->em->persist($record);
        $this->em->flush($record);
    }
}