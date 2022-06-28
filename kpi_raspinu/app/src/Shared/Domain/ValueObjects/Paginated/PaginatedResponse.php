<?php

namespace App\Shared\Domain\ValueObjects\Paginated;


use Doctrine\Common\Collections\ArrayCollection;
use OpenApi\Annotations as OA;

final class  PaginatedResponse
{
    /**
     * @OA\Property(type="array", @OA\Items(type="string"))
     * @var ArrayCollection
     */
    private ArrayCollection $data;
    private PaginatedResponseInfo $info;

    private function __construct(ArrayCollection $data, PaginatedResponseInfo $info)
    {
        $this->data = $data;
        $this->info = $info;
    }

    public static function create(ArrayCollection $collection, int $perPage, int $count, int $countAll, int $page): self
    {
        return new self(
            $collection,
            PaginatedResponseInfo::create(
                $perPage,
                $count,
                $countAll,
                $page
            )
        );
    }

    public function data(): ArrayCollection
    {
        return $this->data;
    }
}