<?php

namespace App\Products\Music\Record\Application\Services;

use App\Products\Music\Record\Application\Command\DeleteRecordCommand;
use App\Products\Music\Record\Domain\RecordCommandRepository;

class DeleteRecordServiceCommand
{
    private RecordCommandRepository $repositoryCommand;


    public function __construct(
        RecordCommandRepository $repositoryCommand,
    )
    {
        $this->repositoryCommand = $repositoryCommand;
    }

    public function __invoke(DeleteRecordCommand $command): void
    {

        $this->repositoryCommand->remove($command);
    }

}