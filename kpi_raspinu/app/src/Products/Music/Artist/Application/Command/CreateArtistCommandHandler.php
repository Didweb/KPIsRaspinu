<?php

namespace App\Products\Music\Artist\Application\Command;

use App\Products\Music\Artist\Application\Services\CreateArtist;
use App\Products\Music\Artist\Application\Services\CreateArtistServiceCommand;
use App\Products\Music\Artist\Domain\ArtistQueryRepository;
use App\Products\Music\Artist\Domain\Exceptions\ArtistExistException;
use App\Products\Music\Artist\Domain\FindArtist;
use App\Products\Music\Artist\Domain\ValueObjects\ArtistId;

class CreateArtistCommandHandler
{
    private CreateArtist $createArtist;
    private FindArtist $finder;


    public function __construct(CreateArtist $createArtist,
                                ArtistQueryRepository $artistQueryRepository)
    {
        $this->createArtist = $createArtist;
        $this->finder = new FindArtist($artistQueryRepository);
    }

    public function __invoke(CreateArtistCommand $command): void
    {
        $artistId = ArtistId::create($command->id());
        $artist = $this->finder->__invoke($artistId);

        if(null !== $artist){
            throw  ArtistExistException::checkByRecordId($artistId);
        }
        $createArtist = new CreateArtistServiceCommand(
            $artistId,
            $command->name()
        );

        $this->createArtist->__invoke($createArtist);
    }


}