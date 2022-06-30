<?php

namespace App\Api\Application\Controller\Record;

use App\Api\Application\Controller\Record\Request\CreateRecordRequest;
use App\Products\Music\Record\Application\Command\CreateRecordCommand;
use App\Products\Music\Record\Domain\Record;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;


class CreateRecordPostController extends ApiController
{

    /**
     * Create a record
     *
     * @Route("/record/create", methods={"POST"}, name="api_record_create")
     *
     *
     * @OA\Tag(
     *     name="Products Records",
     *     description="Operations about records"
     * ),
     * @OA\RequestBody(
     *        required = true,
     *        description = "Data for a Record",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="record",
     *                type="array",
     *                example={{
     *                  "id": "b026b3f4-be48-11eb-8529-0242ac130003",
     *                  "name": "Kaya",
     *                  "artistId": "80007fc6-f7bc-11ec-b939-0242ac120002",
     *                }},
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="id",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="artistId",
     *                         type="string",
     *                         example=""
     *                      ),
     *                ),
     *             ),
     *        ),
     * )
     *     @OA\Response(response="201", description="Created"),
     *     @OA\Response(response="204", description="No Content"),
     *     @OA\Response(response="400", description="Bad request"),
     *     @OA\Response(response="500", description="Internal server error")
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        $request = CreateRecordRequest::fromContent($this->getContent($request));

        $createRecordCommand =  new CreateRecordCommand(
               $request->id(),
                $request->name(),
                $request->artistId(),
            );


        $this->dispatch($createRecordCommand);

        return  $this->makeResponse($createRecordCommand->_toArray(), Response::HTTP_CREATED);
    }

    protected function exceptions(): array
    {
        // TODO: Implement exceptions() method.
        return [];
    }
}