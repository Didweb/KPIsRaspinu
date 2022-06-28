<?php

namespace App\Products\Music\Record\Application\Command;

use App\Products\Music\Record\Application\Services\CreateRecord;
use App\Products\Music\Record\Application\Services\CreateRecordServiceCommand;
use App\Products\Music\Record\Domain\Exceptions\RecordThisIdExists;
use App\Products\Music\Record\Domain\Record;
use App\Products\Music\Record\Domain\RecordFinder;
use App\Products\Music\Record\Domain\RecordQueryRepository;
use App\Products\Music\Record\Domain\ValueObjects\RecordId;
use App\Shared\Domain\Bus\Command\CommandBusInterface;

class CreateRecordCommandHandler
{
    private CreateRecord $createRecord;
    private CommandBusInterface $commandBus;


    public function __construct(CreateRecord $createRecord,
                                CommandBusInterface $commandBus)
    {
        $this->createRecord = $createRecord;
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateRecordCommand $command): void
    {
        $recordId = RecordId::create($command->id());

        $createRecord = new CreateRecordServiceCommand(
            $recordId,
            $command->name()
        );

        $this->createRecord->__invoke($createRecord);
    }



}