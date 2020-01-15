<?php

namespace Kachuru\Zone\Langton\Transition\AntTurn;

use Kachuru\Zone\Langton\AntState;

interface AntTurn
{
    public function getNewAntDirection(AntState $currentAntState): AntState;
}