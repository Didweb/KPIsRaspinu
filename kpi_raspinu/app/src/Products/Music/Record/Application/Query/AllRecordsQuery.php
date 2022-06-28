<?php

namespace App\Products\Music\Record\Application\Query;

use App\Shared\Domain\Bus\Query\Query;

final class AllRecordsQuery extends Query
{
    private int $page;
    private int $pageSize;


    public function __construct(int $page, int $pageSize)
    {
        $this->page = $page;
        $this->pageSize = $pageSize;
    }

    public function page(): int
    {
        return $this->page;
    }

    public function pageSize(): int
    {
        return $this->pageSize;
    }


}