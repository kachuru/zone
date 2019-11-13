<?php


namespace Kachuru\Zone\Langton\Transition;

use Kachuru\Zone\Langton\AntState;

class GammaStateTransition implements StateTransition
{

    public function getNextAntState(AntState $currentAntState): AntState
    {
        return new AntState(
            (new AntState($currentAntState->getClockwiseOrientation()))->getClockwiseOrientation()
        );
    }
}
