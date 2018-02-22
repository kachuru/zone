<?php

namespace Kachuru\Zone\Map;

class HexagonalMap implements Map
{
    private $mapTiles;

    private $mapTileIdsMapping = [];

    private $mapTileCoordinatesMapping = [];

    public function __construct(array $mapTiles)
    {
        $this->mapTiles = $mapTiles;
    }

    public function getMapTiles(): array
    {
        return $this->mapTiles;
    }

    public function getMapTileById(string $tileId): MapTile
    {
        if (empty($this->mapTileIdsMapping)) {
            $this->generateMapTileIdsMapping();
        }

        return $this->mapTiles[$this->mapTileIdsMapping[$tileId]];
    }

    public function getMapTileByCoordinates(MapCoordinates $mapCoordinates): MapTile
    {
        if (empty($this->mapTileCoordinatesMapping)) {
            $this->generateMapTileCoordinatesMapping();
        }

        return $this->mapTiles[$this->mapTileCoordinatesMapping[(string) $mapCoordinates]];
    }

    private function generateMapTileIdsMapping(): void
    {
        foreach ($this->mapTiles as $index => $mapTile) {
            $this->mapTileIdsMapping[$mapTile->getTileId()] = $index;
        }
    }

    private function generateMapTileCoordinatesMapping(): void
    {
        foreach ($this->mapTiles as $index => $mapTile) {
            /** @var $mapTile MapTile */
            $this->mapTileCoordinatesMapping[(string) $mapTile->getCoordinates()] = $index;
        }
    }
}
