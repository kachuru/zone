<?php

namespace Kachuru\Zone\Map;

use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\MapTileState;

interface MapBuilder
{
    public function initialise(): Map;
    public function build(): Map;
    public function move(MapTileState $mapTileState, AntState $antState);

}
