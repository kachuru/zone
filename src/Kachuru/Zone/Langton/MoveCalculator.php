<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapTile;
use Kachuru\Zone\Langton\Transition\TransitionHandler;
use Kachuru\Zone\Map\MapTileState;

class MoveCalculator
{
    private $transitionHandler;

    public function __construct(TransitionHandler $transitionHandler)
    {
        $this->transitionHandler = $transitionHandler;
    }

    public function getMove(Map $map, MapTileState $mapTileState, AntState $antState): LangtonMove
    {
        return new LangtonMove(
            $this->getNewAntState($mapTileState, $antState),
            $this->getNewAntPosition($map, $mapTileState, $antState),
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

    private function getNewAntPosition(Map $map, MapTileState $mapState, AntState $antState): MapTile
    {
        return $map->getMapTileInDirection(
            $mapState->getMapTileCoordinates(),
            $this->getNewAntState($mapState, $antState)->getOrientation()
        );
    }

    private function getCurrentTileNewState($mapTileState): MapTileState
    {
        return $this->transitionHandler->getMapTileNextState($mapTileState);
    }
}
