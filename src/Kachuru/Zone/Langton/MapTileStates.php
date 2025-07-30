<?php

namespace Kachuru\Zone\Langton;

use Kachuru\MapMaker\MapTile;

class MapTileStates
{
    /** @var MapTileWithState[] $tiles */
    private array $tiles = [];

    public function hasTile(int $tileId): bool
    {
        return array_key_exists($tileId, $this->tiles);
    }

    public function getTile(int $tileId): MapTile
    {
        return $this->tiles[$tileId];
    }

    public function setTile(MapTileWithState $mapTileWithState): void
    {
        $this->tiles[$mapTileWithState->getTileId()] = $mapTileWithState;
    }
}
