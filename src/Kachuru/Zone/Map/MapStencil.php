<?php

namespace Kachuru\Zone\Map;

class MapStencil implements Map
{
    private $size;
    private $mapTileFactory;

    public function __construct(MapSize $mapSize, MapTileFactory $mapTileFactory)
    {
        $this->size = $mapSize;
        $this->mapTileFactory = $mapTileFactory;
    }

    public function getMapTiles(): iterable
    {
        for ($y = 0; $y < $this->size->getYSize(); $y++) {
            for ($x = 0; $x < $this->size->getXSize(); $x++) {
                yield $this->mapTileFactory->createTile(
                    $this->size->getXSize() * $y + $x,
                    $this->mapTileFactory->createMapCoordinates($x, $y)
                );
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
