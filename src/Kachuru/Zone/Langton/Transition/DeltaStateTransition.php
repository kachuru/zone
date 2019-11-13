<?php

namespace Kachuru\Zone\Langton\Transition;

use Kachuru\Zone\Langton\AntState;

class DeltaStateTransition implements StateTransition
{
    public function getNextAntState(AntState $currentAntState): AntState
    {
        return new AntState(
            (new AntState($currentAntState->getAnticlockwiseOrientation()))->getAnticlockwiseOrientation()
        );
    }
}
