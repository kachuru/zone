<?php

namespace Kachuru\Zone\Langton\Transition\AntTurn;

class AntTurnFactory
{
    public function getAntTurns()
    {
        return [
            new AntTurnClockwiseOnce(),
            new AntTurnAnticlockwiseOnce(),
            new AntTurnClockwiseTwice(),
            new AntTurnAnticlockwiseTwice()
        ];
    }
}