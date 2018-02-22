<?php

namespace Kachuru\Zone\Map;

interface Map
{
    public function getMapTiles(): array;

    public function getMapTileById(string $tileId): MapTile;

    public function getMapTileByCoordinates(MapCoordinates $mapCoordinates): MapTile;
}
