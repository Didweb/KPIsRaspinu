<?php

namespace App\Api\Application\Controller\Record;

use App\Products\Music\Record\Application\Query\AllRecordsQuery;

use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Infrastructure\QueryBusInterface;
use App\Shared\Infrastructure\Symfony\ApiController;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

final class AllRecordsGetController extends ApiController
{

    private QueryBusInterface $queryBus;

    public function __construct(QueryBusInterface $queryBus) {

        $this->queryBus = $queryBus;
    }

    /**
     * List Records
     *
     * @Route("/records/list", methods={"GET"}, name="api_record_list")
     * @OA\Tag(
     *     name="Products Records",
     *     description="Operations about records"
     * ),
     * @OA\Parameter(parameter="page",name="page",
     *     description="Requested page number",
     *     @OA\Schema(type="string"),
     *     in="query", required=false)
     * @OA\Parameter(parameter="pageSize",name="pageSize",
     *     description="Page size. Number of elements per page.",
     *     @OA\Schema(type="string"), in="query", required=false),
     * @OA\Response(
     *        response="200",
     *        description="Success: Records listed",
     *     )
     *
     */
    public function __invoke(Request $request): Response
    {
        $records = $this->queryBus->dispatch(
            new AllRecordsQuery(
                (int)$request->get('page', 1),
                (int)$request->get('pageSize')
            )
        );

        return $this->makeObjectResponse($records);
    }

    protected function exceptions(): array
    {
        return [];
    }
}