<?php

namespace Kachuru\Zone\Langton\Transition;

use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurn;
use Kachuru\Zone\Map\MapTileState;

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

    public function getNextTileState(MapTileState $currentTileState): MapTileState
    {
        return new MapTileState($currentTileState->getMapTile(), $this->nextState);
    }
}
