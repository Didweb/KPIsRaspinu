<?php

namespace App\Products\Music\Record\Infrastructure\Doctrine\Repository;

use App\Products\Music\Record\Application\Command\DeleteRecordCommand;
use App\Products\Music\Record\Application\Command\UpdateRecordCommand;
use App\Products\Music\Record\Domain\Exceptions\RecordNotFoundException;
use App\Products\Music\Record\Domain\Exceptions\RecordThisIdExists;
use App\Products\Music\Record\Domain\Record;
use App\Products\Music\Record\Domain\RecordCommandRepository;
use App\Products\Music\Record\Domain\RecordQueryRepository;
use App\Products\Music\Record\Domain\ValueObjects\RecordId;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Exception;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DoctrineRecordResponseRepository implements RecordCommandRepository
{

    private EntityManagerInterface $em;
    private RecordQueryRepository $repositoryQuery;


    public function __construct(EntityManagerInterface $em,
                                RecordQueryRepository $repositoryQuery
    )
    {
        $this->em = $em;
        $this->repositoryQuery = $repositoryQuery;
    }


    public function create(Record $record): void
    {

        $this->em->persist($record);
        $this->em->flush($record);
    }


    public function save(Record $record): void
    {
        $idToCheck = RecordId::create($record->id());

        $existId = $this->repositoryQuery->findOneBy($idToCheck);

        if (null === $existId) {
            throw RecordNotFoundException::checkByRecordId($idToCheck);
        }

        $this->em->persist($record);
        $this->em->flush($record);
    }


    public function remove(DeleteRecordCommand $command): void
    {
        $recordId = RecordId::create($command->id());

        $record = $this->repositoryQuery->findOneBy($recordId);

        if(null === $record) {
            throw new Exception('RecordId: '.$recordId.' Not Exist. [59]');
        }

        $this->em->remove($record);
        $this->em->flush();
    }

    public function update(UpdateRecordCommand $command): void
    {
        $recordId = RecordId::create($command->id());

        $record = $this->repositoryQuery->findOneBy($recordId);

        if(null === $record) {
            throw new Exception('RecordId: '.$recordId.' Not Exist. [73]');
        }


    }
}