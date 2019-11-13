<?php


namespace Kachuru\Zone\Langton\Transition;

use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\MapTileState;

class GammaStateTransition implements StateTransition
{

    public function getNextAntState(AntState $currentAntState): AntState
    {
        return new AntState(
            (new AntState($currentAntState->getClockwiseOrientation()))->getClockwiseOrientation()
        );
    }

    public function getNextTileState(MapTileState $currentTileState): MapTileState
    {
        return new MapTileState($currentTileState->getMapTile(), MapTileState::TILE_STATE_DELTA);
    }
}
