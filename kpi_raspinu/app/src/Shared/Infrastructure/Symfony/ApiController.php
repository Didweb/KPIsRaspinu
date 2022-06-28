<?php

namespace App\Shared\Infrastructure\Symfony;

use App\Shared\Infrastructure\QueryBusInterface;
use Exception;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use App\Shared\Domain\Bus\Command\Command;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Command\CommandBusInterface;
use App\Shared\Domain\Bus\Query\Query;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


abstract class ApiController
{
    private CommandBusInterface $commandBusInterface;
    private QueryBusInterface $queryBusInterface;
    private SerializerInterface $serializer;

    public function __construct(CommandBusInterface $commandBus, QueryBusInterface $queryBus,
//                                SerializerInterface $serializer
    )
    {
//        $this->serializer = SerializerBuilder::create()->build();
        $this->commandBusInterface = $commandBus;
        $this->queryBusInterface = $queryBus;
//        $this->serializer = $serializer;
    }

    abstract protected function exceptions(): array;

    protected function dispatch(Command $command): void
    {
        $this->commandBusInterface->dispatch($command);
    }

    /** @return mixed */
    protected function ask(Query $query)
    {
        return $this->queryBusInterface->dispatch($query);
    }

    public function makeResponse(array $data, int $httpCode = Response::HTTP_OK): JsonResponse
    {   $this->serializer = SerializerBuilder::create()->build();
        return new JsonResponse(
            $this->serializer->serialize($data, 'json'),
            $httpCode,
            [],
            true
        );
    }

    public function makeObjectResponse($response, int $httpCode = Response::HTTP_OK, array $serializationGroups = []): JsonResponse
    {
        $this->serializer = SerializerBuilder::create()->build();
        return new JsonResponse(
            $this->serializer->serialize(
                $response,
                'json'
            ),
            $httpCode,
            [],
            true
        );
    }

    public function getContent(Request $request): array
    {
        $content = $request->getContent();

        if (!is_string($content)) {
            throw new Exception('Content must be of type string');
        }

        return json_decode($content, true);
    }

}