<?php

namespace App\Shared\Infrastructure;

use App\Shared\Domain\Bus\Query\Query;

interface QueryBusInterface
{
    /**
     * @psalm-suppress MissingReturnType
     * @phpstan-ignore-next-line
     */
    public function dispatch(Query $query);
}