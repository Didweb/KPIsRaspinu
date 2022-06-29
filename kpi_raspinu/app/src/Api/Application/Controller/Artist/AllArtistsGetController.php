<?php

namespace App\Api\Application\Controller\Artist;

use App\Products\Music\Artist\Application\Query\AllArtistsQuery;
use App\Shared\Infrastructure\QueryBusInterface;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class AllArtistsGetController extends ApiController
{
    private QueryBusInterface $queryBus;


    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * List Artists
     *
     * @Route("/artist/list", methods={"GET"}, name="api_artist_list")
     * @OA\Tag(
     *     name="Products Artist",
     *     description="Operations about artists"
     * ),
     * @OA\Parameter(parameter="page",name="page",
     *     description="Requested page number",
     *     @OA\Schema(type="string"),
     *     in="query", required=false)
     * @OA\Parameter(parameter="pageSize",name="pageSize",
     *     description="Page size. Number of elements per page.",
     *     @OA\Schema(type="string"), in="query", required=false),
     *
     * @OA\Response(response="200", description="Success: Artists listed"),
     * @OA\Response(response="201", description="Created"),
     * @OA\Response(response="204", description="No Content"),
     * @OA\Response(response="400", description="Bad request"),
     * @OA\Response(response="500", description="Internal server error"),
     *
     */
    public function __invoke(Request $request): Response
    {
        $records = $this->queryBus->dispatch(
            new AllArtistsQuery(
                (int)$request->get('page', 1),
                (int)$request->get('pageSize')
            )
        );

        return $this->makeObjectResponse($records);
    }

    protected function exceptions(): array
    {
        // TODO: Implement exceptions() method.
        return [];
    }
}