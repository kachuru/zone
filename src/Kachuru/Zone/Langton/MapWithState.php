<?php

namespace Kachuru\Zone\Langton;

use Kachuru\MapMaker\Map;

interface MapWithState extends Map
{
    public function updateTile(MapTileWithState $mapTileWithState): void;
}
