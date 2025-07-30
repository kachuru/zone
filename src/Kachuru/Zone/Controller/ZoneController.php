<?php

namespace Kachuru\Zone\Controller;

use Kachuru\MapMaker\Map;
use Kachuru\Zone\Dto\Langton\LangtonMove as LangtonMoveDto;
use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\LangtonFactory;
use Kachuru\Zone\Langton\LangtonMove;
use Kachuru\Zone\Langton\MapTileWithState;
use Kachuru\Zone\Langton\Seed;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ZoneController extends AbstractController
{
    #[Route('/map', name: 'map')]
    #[Route('/map/{seed}', name: 'map_with_seed', requirements: ['seed' => '\d+'])]
    public function map(LangtonFactory $langtonFactory, string $seed = null): Response
    {
        $seed = $langtonFactory->getSeed($seed ?? Seed::getTransitionsRandomSeed());
        $map = $langtonFactory->getStatefulMap($seed);
        $seededMapBuilder = $langtonFactory->getSeededMapBuilder($seed);

        return $this->render('@Zone/default/map.html.twig', [
            'map' => $seededMapBuilder->build($map, 2) // $this->getParameter('app.ant_steps'))
        ]);
    }

    #[Route('/langton/move', name: 'langton_move')]
    public function langtonMove(Request $request, LangtonFactory $langtonFactory): JsonResponse
    {
        $seed = $langtonFactory->getSeed((string) $request->request->get('seed'));
        $map = $langtonFactory->getMapStencil();
        $seededMapBuilder = $langtonFactory->getSeededMapBuilder($seed);
        $state = $request->request->get('state');

        if ($state == 'none') {
            $state = MapTileWithState::TILE_STATE_HANDLES[$seed->getFirstState()];
        }

        return $this->json(
            $this->getLangtonMoveDto(
                $seededMapBuilder->move(
                    $map,
                    new MapTileWithState(
                        $map->getMapTileByTileId((int) $request->request->get('tileId')),
                        array_flip(MapTileWithState::TILE_STATE_HANDLES)[$state]
                    ),
                    new AntState((int) array_flip(Map::DIRECTION_HANDLES)[$request->request->get('orientation')])
                )
            )
        );
    }

    #[Route('/langton', name: 'langton')]
    #[Route('/langton/{seed}', name: 'langton_with_seed', requirements: ['seed' => '\d+'])]
    public function langton(LangtonFactory $langtonFactory, string $seed = null): Response
    {
        $seed = $langtonFactory->getSeed($seed ?? Seed::getTransitionsRandomSeed());
        $map = $langtonFactory->getMapStencil();

        return $this->render('@Zone/default/langton.html.twig', [
            'map' => $map,
            'initial' => $map->getCentreTile(),
            'seed' => $seed->getSeed(),
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
