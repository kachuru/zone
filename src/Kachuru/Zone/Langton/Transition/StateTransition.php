<?php

namespace Kachuru\Zone\Langton\Transition;

use Kachuru\Zone\Langton\AntState;

interface StateTransition
{
    public function getNextAntState(AntState $currentAntState): AntState;
}
