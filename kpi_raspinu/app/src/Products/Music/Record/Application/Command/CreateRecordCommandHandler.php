<?php

namespace App\Products\Music\Record\Application\Command;

use App\Products\Music\Artist\Domain\ValueObjects\ArtistId;
use App\Products\Music\Record\Application\Services\CreateRecord;
use App\Products\Music\Record\Application\Services\CreateRecordServiceCommand;
use App\Products\Music\Record\Domain\Exceptions\RecordExistException;
use App\Products\Music\Record\Domain\Exceptions\RecordNotFoundException;
use App\Products\Music\Record\Domain\Exceptions\RecordThisIdExists;
use App\Products\Music\Record\Domain\Record;
use App\Products\Music\Record\Domain\RecordFinder;
use App\Products\Music\Record\Domain\RecordQueryRepository;
use App\Products\Music\Record\Domain\ValueObjects\RecordId;
use App\Shared\Domain\Bus\Command\CommandBusInterface;

class CreateRecordCommandHandler
{
    private CreateRecord $createRecord;
    private RecordFinder $finder;


    public function __construct(CreateRecord $createRecord,
                                RecordQueryRepository $recordQueryRepository)
    {
        $this->createRecord = $createRecord;
        $this->finder = new RecordFinder($recordQueryRepository);
    }

    public function __invoke(CreateRecordCommand $command): void
    {
        $recordId = RecordId::create($command->id());
        $record = $this->finder->__invoke($recordId);

        if(null !== $record){
            throw  RecordExistException::checkByRecordId($recordId);
        }
        $createRecord = new CreateRecordServiceCommand(
            $recordId,
            $command->name(),
            ArtistId::create($command->artist_id())
        );


        $this->createRecord->__invoke($createRecord);
    }



}