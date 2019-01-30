<?php

namespace Kachuru\Zone\Map;

class MapStencil implements Map
{
    private const ADJACENT_COORDINATE_ADJUSTMENTS_EVEN = [[0, -1], [1, -1], [1, 0], [0, 1], [-1, 0], [-1, -1]];

    private const ADJACENT_COORDINATE_ADJUSTMENTS_ODD = [[0, -1], [1, 0], [1, 1], [0, 1], [-1, 1], [-1, 0]];

    private $mapSize;

    private $mapTileFactory;

    public function __construct(MapSize $mapSize, MapTileFactory $mapTileFactory)
    {
        $this->mapSize = $mapSize;
        $this->mapTileFactory = $mapTileFactory;
    }

    public function getMapTileByTileId(string $tileId): MapTile
    {
        return $this->mapTileFactory->createTile($tileId, $this->getCoordinatesFromTileId($tileId));
    }

    public function getMapTileByCoordinates(MapCoordinates $mapCoordinates): MapTile
    {
        return $this->mapTileFactory->createTile($this->getTileIdFromCoordinates($mapCoordinates), $mapCoordinates);
    }

    public function getMapTiles(): iterable
    {
        for ($tileId = 0; $tileId < $this->mapSize->getSize(); $tileId++) {
            yield $this->getMapTileByTileId($tileId);
        }
    }

    public function getAdjacentTiles(MapCoordinates $mapCoordinates): iterable
    {
        $adjustments = $mapCoordinates->getX() % 2 == 0
            ? self::ADJACENT_COORDINATE_ADJUSTMENTS_EVEN
            : self::ADJACENT_COORDINATE_ADJUSTMENTS_ODD;

        foreach ($adjustments as $coordinateAdjustment) {
            yield $this->getMapTileByCoordinates(
                $this->mapTileFactory->createMapCoordinates(
                    $mapCoordinates->getX() + $coordinateAdjustment[0],
                    $mapCoordinates->getY() + $coordinateAdjustment[1]
                )
            );
        }
    }

    private function getCoordinatesFromTileId(int $tileId): MapCoordinates
    {
        return $this->mapTileFactory->createMapCoordinates(
            $tileId % $this->mapSize->getXSize(),
            floor($tileId / $this->mapSize->getXSize())
        );
    }

    private function getTileIdFromCoordinates(MapCoordinates $mapCoordinates): int
    {
        return $mapCoordinates->getY() * $this->mapSize->getXSize() + $mapCoordinates->getX();
    }
}
