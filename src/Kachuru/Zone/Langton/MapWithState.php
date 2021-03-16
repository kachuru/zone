<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapTile;

interface MapWithState extends Map
{
    public function updateTile(MapTileWithState $mapTileWithState): void;
}
