<?php

namespace Kachuru\Zone\Langton\Transition;

use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurn;
use Kachuru\Zone\Map\MapTileWithState;

class StateTransition
{
    private $antTurn;

    private $nextState;

    public function __construct(AntTurn $antTurn, int $nextState)
    {
        $this->antTurn = $antTurn;
        $this->nextState = $nextState;
    }

    public function getNextAntState(AntState $currentAntState): AntState
    {
        return $this->antTurn->getNewAntDirection($currentAntState);
    }

    public function getNextTileState(MapTileWithState $currentTileState): MapTileWithState
    {
        return new MapTileWithState($currentTileState->getMapTile(), $this->nextState);
    }
}
