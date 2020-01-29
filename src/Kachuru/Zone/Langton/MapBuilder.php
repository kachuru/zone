<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapTileState;

interface MapBuilder
{
    public function initialise(): Map;
    public function build(int $steps): Map;
    public function move(MapTileState $mapTileState, AntState $antState);
}
