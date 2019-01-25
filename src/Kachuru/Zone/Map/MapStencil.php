<?php

namespace Kachuru\Zone\Map;

class MapStencil implements Map
{
    private $size;

    public function __construct(MapSize $mapSize)
    {
        $this->size = $mapSize;
    }

    public function getMapTiles(): iterable
    {
        for ($y = 0; $y < $this->size->getYSize(); $y++) {
            for ($x = 0; $x < $this->size->getXSize(); $x++) {
                yield new MapTile(($this->size->getXSize() * $y) + $x, new MapCoordinates($x, $y));
            }
        }
    }

    public function getMapTileById(string $tileId): MapTile
    {
        // TODO: Implement getMapTileById() method.
    }

    public function getMapTileByCoordinates(MapCoordinates $mapCoordinates): MapTile
    {
        // TODO: Implement getMapTileByCoordinates() method.
    }
}
