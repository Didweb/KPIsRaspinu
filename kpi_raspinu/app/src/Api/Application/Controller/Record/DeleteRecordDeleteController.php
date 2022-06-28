<?php

namespace App\Api\Application\Controller\Record;

use App\Api\Application\Controller\Record\Request\CreateRecordRequest;
use App\Api\Application\Controller\Record\Request\DeleteRecordRequest;
use App\Products\Music\Record\Application\Command\CreateRecordCommand;
use App\Products\Music\Record\Application\Command\DeleteRecordCommand;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;

class DeleteRecordDeleteController  extends ApiController
{
    /**
     * List Records
     *
     * @Route("/records/delete", methods={"DELETE"}, name="api_record_delete")
     * @OA\Tag(
     *     name="Products Records",
     *     description="Operations about records"
     * ),
     * @OA\Parameter(parameter="id",name="id",
     *     description="Id to delete",
     *     @OA\Schema(type="string"),
     *     in="query", required=false)
     *
     *     @OA\Response(response="201", description="Created"),
     *     @OA\Response(response="204", description="No Content"),
     *     @OA\Response(response="400", description="Bad request"),
     *     @OA\Response(response="500", description="Internal server error")
     *
     */
    public function __invoke(Request $request): Response
    {

        $deleteRecordCommand =  new DeleteRecordCommand(
            $request->get('id')
        );


        $this->dispatch($deleteRecordCommand);

        return  $this->makeResponse($deleteRecordCommand->_toArray(), Response::HTTP_CREATED);
    }

    protected function exceptions(): array
    {
        // TODO: Implement exceptions() method.
        return [];
    }
}