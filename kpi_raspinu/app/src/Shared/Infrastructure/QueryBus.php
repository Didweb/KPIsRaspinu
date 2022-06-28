<?php

namespace App\Shared\Infrastructure;

use App\Shared\Domain\Bus\Query\Query;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

final class QueryBus implements QueryBusInterface
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $commandQuery)
    {
        $this->messageBus = $commandQuery;
    }

    /**
     * @psalm-suppress MissingReturnType
     * @phpstan-ignore-next-line
     */
    public function dispatch(Query $query)
    {
        try {
            $response = $this->messageBus->dispatch($query);

            /** @var HandledStamp $handled */
            $handled = $response->last(HandledStamp::class);

            return $handled->getResult();

        } catch (HandlerFailedException $e) {
            while ($e instanceof HandlerFailedException) {
                /** @var Throwable $e */
                $e = $e->getPrevious();
            }

            throw $e;
        }
    }
}