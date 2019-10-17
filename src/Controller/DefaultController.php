<?php

namespace App\Controller;

use Kachuru\Zone\Dto\Langton\LangtonMove as LangtonMoveDto;
use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\LangtonMove;
use Kachuru\Zone\Langton\MapTileState;
use Kachuru\Zone\Langton\MoveCalculator;
use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapStencil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/map");
     */
    public function map(MapStencil $mapStencil)
    {
        return $this->render('default/map.html.twig', [
            'map' => $mapStencil
        ]);
    }

    /**
     * @Route("/langton");
     */
    public function langton(MoveCalculator $moveCalculator)
    {
        return $this->render('default/langton.html.twig', [
            'map' => $moveCalculator->getMap(),
            'initial' => $moveCalculator->getMap()->getCentreTile()
        ]);
    }

    /**
     * @Route("/langton/move");
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function langtonMove(Request $request, MoveCalculator $moveCalculator)
    {
        /**
         * $request needs to provide current tile ID and co-ordinates, tile state, and ant state
         */
        return $this->json(
            $this->getLangtonMoveDto(
                $moveCalculator->getMove(
                    new MapTileState(
                        $moveCalculator->getMapTileByTileId($request->request->get('tileId')),
                        array_flip(MapTileState::TILE_STATE_HANDLES)[$request->request->get('state')]
                    ),
                    new AntState((int) array_flip(Map::DIRECTION_HANDLES)[$request->request->get('orientation')])
                )
            )
        );
    }

    private function getLangtonMoveDto(LangtonMove $langtonMove): LangtonMoveDto
    {
        return new LangtonMoveDto(
            $langtonMove->getAntNewState()->getOrientationHandle(),
            $langtonMove->getNewLocation()->getTileId(),
            $langtonMove->getOldLocationUpdatedState()->getMapTileId(),
            $langtonMove->getOldLocationUpdatedState()->getStateHandle()
        );
    }
}
