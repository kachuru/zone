<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\MapTile;

class MapTileStates
{
    private $tiles = [];

    public function hasTile(int $tileId): bool
    {
        return array_key_exists($tileId, $this->tiles);
    }

    public function getTile(int $tileId): MapTile
    {
        return $this->tiles[$tileId];
    }

    public function setTile(MapTileWithState $mapTileWithState)
    {
        $this->tiles[$mapTileWithState->getTileId()] = $mapTileWithState;
    }
}
