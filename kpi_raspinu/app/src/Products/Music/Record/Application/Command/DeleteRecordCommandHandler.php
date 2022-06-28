<?php

namespace App\Products\Music\Record\Application\Command;

use App\Products\Music\Record\Application\Services\DeleteRecordServiceCommand;

class DeleteRecordCommandHandler
{
    private DeleteRecordServiceCommand $deleteRecordServiceCommand;


    public function __construct(DeleteRecordServiceCommand $deleteRecord)
    {
        $this->deleteRecordServiceCommand = $deleteRecord;
    }

    public function __invoke(DeleteRecordCommand $command): void
    {
        $this->deleteRecordServiceCommand->__invoke($command);
    }

}