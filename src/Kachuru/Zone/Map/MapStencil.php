<?php

namespace Kachuru\Zone\Map;

class MapStencil implements Map
{
    private const ADJACENT_COORDINATE_ADJUSTMENTS_EVEN = [
        Map::DIRECTION_NORTH => [0, -1],
        Map::DIRECTION_NORTHEAST => [1, -1],
        Map::DIRECTION_SOUTHEAST => [1, 0],
        Map::DIRECTION_SOUTH => [0, 1],
        Map::DIRECTION_SOUTHWEST => [-1, 0],
        Map::DIRECTION_NORTHWEST => [-1, -1]
    ];

    private const ADJACENT_COORDINATE_ADJUSTMENTS_ODD = [
        Map::DIRECTION_NORTH => [0, -1],
        Map::DIRECTION_NORTHEAST => [1, 0],
        Map::DIRECTION_SOUTHEAST => [1, 1],
        Map::DIRECTION_SOUTH => [0, 1],
        Map::DIRECTION_SOUTHWEST => [-1, 1],
        Map::DIRECTION_NORTHWEST => [-1, 0]
    ];

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
        foreach ($this->getAdjustmentList($mapCoordinates) as $coordinateAdjustment) {
            yield $this->getMapTileByCoordinates(
                $this->mapTileFactory->createMapCoordinates(
                    $mapCoordinates->getX() + $coordinateAdjustment[0],
                    $mapCoordinates->getY() + $coordinateAdjustment[1]
                )
            );
        }
    }

    public function getMapTileInDirection(MapCoordinates $mapCoordinates, int $direction): MapTile
    {
        $adjustment = $this->getAdjustmentList($mapCoordinates)[$direction];

        return $this->getMapTileByCoordinates(
            $this->mapTileFactory->createMapCoordinates(
                $mapCoordinates->getX() + $adjustment[0],
                $mapCoordinates->getY() + $adjustment[1]
            )
        );
    }

    public function getCentreTile(): MapTile
    {
        return $this->getMapTileByCoordinates(
            $this->mapTileFactory->createMapCoordinates(
                floor(($this->mapSize->getXSize() - 1) / 2),
                floor(($this->mapSize->getYSize() - 1) / 2)
            )
        );
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
        $tileId = $mapCoordinates->getY() * $this->mapSize->getXSize() + $mapCoordinates->getX();

        if (!$this->isValidTileId($tileId)) {
            throw new \RuntimeException('Invalid Map Coordinates');
        }

        return $tileId;
    }

    private function getAdjustmentList(MapCoordinates $mapCoordinates): array
    {
        return $mapCoordinates->getX() % 2 == 0
            ? self::ADJACENT_COORDINATE_ADJUSTMENTS_EVEN
            : self::ADJACENT_COORDINATE_ADJUSTMENTS_ODD;
    }

    private function isValidTileId($tileId): bool
    {
        return $tileId > 0 && $tileId < $this->mapSize->getSize();
    }
}
