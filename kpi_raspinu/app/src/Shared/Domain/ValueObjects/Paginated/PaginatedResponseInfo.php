<?php

namespace App\Shared\Domain\ValueObjects\Paginated;

class PaginatedResponseInfo
{
    private int $perPage;
    private int $count;
    private int $countAll;
    private int $page;

    private function __construct(int $perPage, int $count, int $countAll, int $page)
    {
        $this->perPage = $perPage;
        $this->count = $count;
        $this->countAll = $countAll;
        $this->page = $page;
    }

    public static function create(int $perPage, int $count, int $countAll, int $page): self
    {
        return new self($perPage, $count, $countAll, $page);
    }
}