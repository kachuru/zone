<?php

namespace Kachuru\Zone\Langton;

use Kachuru\MapMaker\Map;

interface MapBuilder
{
    public function build(MapWithState $map, int $steps): Map;

    public function move(Map $map, MapTileWithState $mapTileWithState, AntState $antState);
}
