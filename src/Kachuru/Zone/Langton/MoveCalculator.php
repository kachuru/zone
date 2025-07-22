<?php

namespace Kachuru\Zone\Langton;

use Kachuru\MapMaker\Map;
use Kachuru\MapMaker\MapTile;
use Kachuru\Zone\Langton\Transition\TransitionHandler;

readonly class MoveCalculator
{
    public function __construct(
        private TransitionHandler $transitionHandler
    ) {
    }

    public function getMove(Map $map, MapTileWithState $mapTileState, AntState $antState): LangtonMove
    {
        return new LangtonMove(
            $this->getNewAntState($mapTileState, $antState),
            $this->getNewAntPosition($map, $mapTileState, $antState),
            $this->getCurrentTileNewState($mapTileState)
        );
    }

    private function getNewAntState(MapTileWithState $mapTileState, AntState $currentAntState): AntState
    {
        return $this->transitionHandler->getAntStateTransitionForMapTileState(
            $mapTileState->getStateHandle(),
            $currentAntState
        );
    }

    private function getNewAntPosition(Map $map, MapTileWithState $mapState, AntState $antState): MapTile
    {
        return $map->getMapTileInDirection(
            $mapState->getCoordinates(),
            $this->getNewAntState($mapState, $antState)->getOrientation()
        );
    }

    private function getCurrentTileNewState(MapTileWithState $mapTileState): MapTileWithState
    {
        return $this->transitionHandler->getMapTileNextState($mapTileState);
    }
}
