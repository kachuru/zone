<?php

namespace Kachuru\Zone\Langton\Transition\AntTurn;

class AntTurnFactory
{
    /** @return AntTurn[] */
    public function getAntTurns(): array
    {
        return [
            new AntTurnClockwiseOnce(),
            new AntTurnAnticlockwiseOnce(),
            new AntTurnClockwiseTwice(),
            new AntTurnAnticlockwiseTwice()
        ];
    }
}
