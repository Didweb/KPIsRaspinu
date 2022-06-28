<?php

namespace App\Products\Music\Record\Domain;

use App\Products\Music\Record\Application\Command\DeleteRecordCommand;
use App\Products\Music\Record\Application\Command\UpdateRecordCommand;

interface RecordCommandRepository
{
    public function save(Record $record): void;

    public function create(Record $record): void;

    public function remove(DeleteRecordCommand $command): void;

    public function update(UpdateRecordCommand $command): void;
}