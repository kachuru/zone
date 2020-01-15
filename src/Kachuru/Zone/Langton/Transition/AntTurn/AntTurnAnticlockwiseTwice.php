<?php

namespace Kachuru\Zone\Langton\Transition\AntTurn;

use Kachuru\Zone\Langton\AntState;

class AntTurnAnticlockwiseTwice implements AntTurn
{
    public function getNewAntDirection(AntState $currentAntState): AntState
    {
        return new AntState(
            (new AntState($currentAntState->getAnticlockwiseOrientation()))->getAnticlockwiseOrientation()
        );
    }
}