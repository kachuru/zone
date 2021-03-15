<?php

namespace App\Controller;

use Kachuru\Zone\Dto\Langton\LangtonMove as LangtonMoveDto;
use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\LangtonMove;
use Kachuru\Zone\Map\MapTileWithState;
use Kachuru\Zone\Langton\Seed;
use Kachuru\Zone\Langton\LangtonFactory;
use Kachuru\Zone\Map\Map;
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
     * @Route("/map/{seedId}");
     */
    public function map(LangtonFactory $langtonFactory, int $seedId = null)
    {
        $seed = $langtonFactory->getSeed($seedId ?? Seed::getTransitionsRandomSeed());
        $map = $langtonFactory->getStatefulMap($seed);
        $seededMapBuilder = $langtonFactory->getSeededMapBuilder($seed);

        return $this->render('default/map.html.twig', [
            'map' => $seededMapBuilder->build($map, $this->getParameter('app.ant_steps'))
        ]);
    }

    /**
     * @Route("/langton/move");
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function langtonMove(Request $request, LangtonFactory $langtonFactory)
    {
        $seed = $langtonFactory->getSeed((int) $request->request->get('seedId'));
        $map = $langtonFactory->getMapStencil();
        $seededMapBuilder = $langtonFactory->getSeededMapBuilder($seed);
        $state = $request->request->get('state');

        if ($state == 'none') {
            $state = MapTileWithState::TILE_STATE_HANDLES[$seed->getFirstState()];
        }

        /**
         * $request needs to provide current tile ID and co-ordinates, tile state, and ant state
         */
        return $this->json(
            $this->getLangtonMoveDto(
                $seededMapBuilder->move(
                    $map,
                    new MapTileWithState(
                        $map->getMapTileByTileId($request->request->get('tileId')),
                        array_flip(MapTileWithState::TILE_STATE_HANDLES)[$state]
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
    public function langton(LangtonFactory $langtonFactory, int $seedId = null)
    {
        $seed = $langtonFactory->getSeed($seedId ?? Seed::getTransitionsRandomSeed());
        $map = $langtonFactory->getMapStencil();

        return $this->render('default/langton.html.twig', [
            'map' => $map,
            'initial' => $map->getCentreTile(),
            'seedId' => $seed->getSeedId(),
            'steps' => $this->getParameter('app.ant_steps')
        ]);
    }

    private function getLangtonMoveDto(LangtonMove $langtonMove): LangtonMoveDto
    {
        return new LangtonMoveDto(
            $langtonMove->getAntNewState()->getOrientationHandle(),
            $langtonMove->getNewLocation()->getTileId(),
            $langtonMove->getOldLocationUpdatedState()->getTileId(),
            $langtonMove->getOldLocationUpdatedState()->getStateHandle()
        );
    }
}
