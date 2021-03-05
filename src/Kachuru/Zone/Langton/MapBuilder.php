<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapTileState;

interface MapBuilder
{
    public function build(Map $map, int $steps): Map;
    public function move(Map $map, MapTileState $mapTileState, AntState $antState);
}
