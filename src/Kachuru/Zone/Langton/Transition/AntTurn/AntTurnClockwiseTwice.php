<?php

namespace Kachuru\Zone\Langton\Transition\AntTurn;

use Kachuru\Zone\Langton\AntState;

class AntTurnClockwiseTwice implements AntTurn
{
    public function getNewAntDirection(AntState $currentAntState): AntState
    {
        return new AntState(
            (new AntState($currentAntState->getClockwiseOrientation()))->getClockwiseOrientation()
        );
    }
}