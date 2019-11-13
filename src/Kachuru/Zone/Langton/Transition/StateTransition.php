<?php

namespace Kachuru\Zone\Langton\Transition;

use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\MapTileState;

interface StateTransition
{
    public function getNextAntState(AntState $currentAntState): AntState;

    public function getNextTileState(MapTileState $mapTileState): MapTileState;
}
