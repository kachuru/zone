<?php

namespace Kachuru\Zone\Map;

interface Map
{
    public function getMapTiles(): iterable;

    public function getMapTileById(string $tileId): MapTile;

    public function getMapTileByCoordinates(MapCoordinates $mapCoordinates): MapTile;
}
