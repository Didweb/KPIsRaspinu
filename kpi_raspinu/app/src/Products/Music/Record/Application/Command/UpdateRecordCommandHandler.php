<?php

namespace App\Products\Music\Record\Application\Command;

use App\Products\Music\Artist\Domain\ValueObjects\ArtistId;
use App\Products\Music\Record\Application\Services\UpdateRecordServiceCommand;
use App\Products\Music\Record\Domain\Exceptions\RecordNotFoundException;
use App\Products\Music\Record\Domain\RecordCommandRepository;
use App\Products\Music\Record\Domain\RecordFinder;
use App\Products\Music\Record\Domain\RecordQueryRepository;
use App\Products\Music\Record\Domain\ValueObjects\RecordId;
use App\Shared\Infrastructure\QueryBusInterface;

class UpdateRecordCommandHandler
{
    private RecordQueryRepository $recordQueryRepository;
    private RecordCommandRepository $recordCommandRepository;
    private RecordFinder $finder;



    public function __construct(RecordCommandRepository $recordCommandRepository,
                                RecordQueryRepository $recordQueryRepository)
    {
        $this->recordQueryRepository = $recordQueryRepository;
        $this->recordCommandRepository = $recordCommandRepository;
        $this->finder = new RecordFinder($recordQueryRepository);
    }

    public function __invoke(UpdateRecordCommand $command): void
    {
        $recordId = RecordId::create($command->id());
        $record = $this->finder->__invoke($recordId);

        if(null === $record){
            throw  RecordNotFoundException::checkByRecordId($recordId);
        }

        $name = $command->name();
        $artist_id = ArtistId::create($command->artist_id());

        $serviceCommand = new UpdateRecordServiceCommand(
            $recordId,
            $name,
            $artist_id
        );

        $record->update($serviceCommand);
        $this->recordCommandRepository->save($record);

    }


}