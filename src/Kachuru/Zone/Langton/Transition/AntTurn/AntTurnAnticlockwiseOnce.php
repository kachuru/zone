<?php

namespace Kachuru\Zone\Langton\Transition\AntTurn;

use Kachuru\Zone\Langton\AntState;

class AntTurnAnticlockwiseOnce implements AntTurn
{
    public function getNewAntDirection(AntState $currentAntState): AntState
    {
        return new AntState($currentAntState->getAnticlockwiseOrientation());
    }
}