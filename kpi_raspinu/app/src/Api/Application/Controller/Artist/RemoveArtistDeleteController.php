<?php

namespace App\Api\Application\Controller\Artist;

use App\Products\Music\Artist\Application\Command\RemoveArtistCommand;
use App\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;

class RemoveArtistDeleteController extends ApiController
{
    /**
     * Remove Artist
     *
     * @Route("/artist/delete", methods={"DELETE"}, name="api_artist_delete")
     * @OA\Tag(
     *     name="Products Artist",
     *     description="Operations about artist"
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
        $removeArtistCommand = new RemoveArtistCommand(
            $request->get('id')
        );

        $this->dispatch($removeArtistCommand);

        return $this->makeResponse($removeArtistCommand->_toArray(), Response::HTTP_CREATED);
    }


    protected function exceptions(): array
    {
        // TODO: Implement exceptions() method.
        return [];
    }
}