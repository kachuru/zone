<?php

namespace Kachuru\Zone\Langton\Transition;

use Kachuru\Zone\Langton\AntState;

class AlphaStateTransition implements StateTransition
{
    public function getNextAntState(AntState $currentAntState): AntState
    {
        return new AntState($currentAntState->getClockwiseOrientation());
    }
}
