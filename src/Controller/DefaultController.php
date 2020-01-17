<?php

namespace App\Controller;

use Kachuru\Zone\Dto\Langton\LangtonMove as LangtonMoveDto;
use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\LangtonMove;
use Kachuru\Zone\Langton\MapTileState;
use Kachuru\Zone\Langton\Seed;
use Kachuru\Zone\Langton\SeedFactory;
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
     * @Route("/langton/move");
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function langtonMove(Request $request, SeedFactory $seededMapBuilderFactory)
    {
        $seed = $seededMapBuilderFactory->getSeed((int) $request->request->get('seedId'));
        $seededMapBuilder = $seededMapBuilderFactory->getSeededMapBuilder($seed);
        $map = $seededMapBuilder->initialise();

        $state = $request->request->get('state');

        if ($state == 'none') {
            $state = MapTileState::TILE_STATE_HANDLES[$seed->getFirstState()];
        }

        /**
         * $request needs to provide current tile ID and co-ordinates, tile state, and ant state
         */
        return $this->json(
            $this->getLangtonMoveDto(
                $seededMapBuilder->move(
                    new MapTileState(
                        $map->getMapTileByTileId($request->request->get('tileId')),
                        array_flip(MapTileState::TILE_STATE_HANDLES)[$state]
                    ),
                    new AntState((int) array_flip(Map::DIRECTION_HANDLES)[$request->request->get('orientation')])
                )
            )
        );
    }

    /**
     * @Route("/langton");
     * @Route("/langton/{seedId}");
     */
    public function langton(SeedFactory $seededMapBuilderFactory, int $seedId = null)
    {
        $seed = $seededMapBuilderFactory->getSeed($seedId ?? Seed::getTransitionsRandomSeed());
        $seededMapBuilder = $seededMapBuilderFactory->getSeededMapBuilder($seed);
        $map = $seededMapBuilder->initialise();

        return $this->render('default/langton.html.twig', [
            'map' => $map,
            'initial' => $map->getCentreTile(),
            'seedId' => $seed->getSeedId()
        ]);
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
