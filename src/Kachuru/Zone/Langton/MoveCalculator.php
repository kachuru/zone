<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapTile;
use Kachuru\Zone\Langton\Transition\TransitionHandler;

class MoveCalculator
{
    private $map;

    private $transitionHandler;

    public function __construct(Map $map, TransitionHandler $transitionHandler)
    {
        $this->map = $map;
        $this->transitionHandler = $transitionHandler;
    }

    public function getMap(): Map
    {
        return $this->map;
    }

    public function getMapTileByTileId(int $tileId): MapTile
    {
        return $this->map->getMapTileByTileId($tileId);
    }

    public function getMove(MapTileState $mapTileState, AntState $antState): LangtonMove
    {
        return new LangtonMove(
            $this->getNewAntState($mapTileState, $antState),
            $this->getNewAntPosition($mapTileState, $antState),
            $this->getCurrentTileNewState($mapTileState)
        );
    }

    private function getNewAntState(MapTileState $mapTileState, AntState $currentAntState): AntState
    {
        return $this->transitionHandler->getAntStateTransitionForMapTileState(
            $mapTileState->getStateHandle(),
            $currentAntState
        );
    }

    private function getNewAntPosition(MapTileState $mapState, AntState $antState): MapTile
    {
        return $this->map->getMapTileInDirection(
            $mapState->getMapTileCoordinates(),
            $this->getNewAntState($mapState, $antState)->getOrientation()
        );
    }

    private function getCurrentTileNewState($mapTileState): MapTileState
    {
        return $this->transitionHandler->getMapTileNextState($mapTileState);
    }
}
