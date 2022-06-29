<?php

namespace App\Api\Application\Controller\Artist;

use App\Api\Application\Controller\Artist\Request\CreateArtistRequest;
use App\Products\Music\Artist\Application\Command\CreateArtistCommand;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;

class CreateArtistPostController extends ApiController
{
    /**
     * Create a artist
     *
     * @Route("/artist/create", methods={"POST"}, name="api_artist_create")
     *
     *
     * @OA\Tag(
     *     name="Products Artist",
     *     description="Operations about artist"
     * ),
     * @OA\RequestBody(
     *        required = true,
     *        description = "Data for a Artist",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="artist",
     *                type="array",
     *                example={{
     *                  "id": "80007fc6-f7bc-11ec-b939-0242ac120002",
     *                  "name": "Bob Marley"
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
        $request = CreateArtistRequest::fromContent($this->getContent($request));

        $createArtistCommend = new CreateArtistCommand(
            $request->id(),
            $request->name()
        );

        $this->dispatch($createArtistCommend);

        return  $this->makeResponse($createArtistCommend->_toArray(), Response::HTTP_CREATED);
    }


    protected function exceptions(): array
    {
        // TODO: Implement exceptions() method.
        return [];
    }
}