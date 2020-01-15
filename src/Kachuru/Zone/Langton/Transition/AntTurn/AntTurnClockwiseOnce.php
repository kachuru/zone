<?php

namespace Kachuru\Zone\Langton\Transition\AntTurn;

use Kachuru\Zone\Langton\AntState;

class AntTurnClockwiseOnce implements AntTurn
{
    public function getNewAntDirection(AntState $currentAntState): AntState
    {
        return new AntState($currentAntState->getClockwiseOrientation());
    }
}