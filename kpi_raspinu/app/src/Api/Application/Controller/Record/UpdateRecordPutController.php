<?php

namespace App\Api\Application\Controller\Record;

 use App\Api\Application\Controller\Record\Request\UpdateRecordRequest;
 use App\Products\Music\Record\Application\Command\UpdateRecordCommand;
 use App\Shared\Domain\Bus\Command\CommandBusInterface;
 use App\Shared\Infrastructure\Symfony\ApiController;
 use Symfony\Component\Routing\Annotation\Route;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
 use OpenApi\Annotations as OA;

 class UpdateRecordPutController extends ApiController
{
    private CommandBusInterface $commandBus;


     public function __construct(CommandBusInterface $commandBus)
     {
         $this->commandBus = $commandBus;
     }



     /**
      * Update a Record
      *
      * @Route("/record/update/{id}", methods={"PUT"}, name="api_record_update")
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
      *                  "name": "Kaya"
      *                }},
      *                @OA\Items(
      *                      @OA\Property(
      *                         property="name",
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
      */
     public function __invoke(string $id, Request $request): Response
     {
         $request = UpdateRecordRequest::fromContent($this->getContent($request));

         $this->commandBus->dispatch(
             new UpdateRecordCommand(
                 $id,
                 $request->name()
             )
         );

         return $this->makeResponse(['code'=>201,'status'=>'Updated','itemUpdated'=>$id], Response::HTTP_CREATED);
     }

     protected function exceptions(): array
     {
         // TODO: Implement exceptions() method.
         return [];
     }
 }