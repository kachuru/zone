<?php

namespace Kachuru\Zone\Map;

class MapTileFactory
{
    public function createTile(int $tileId, MapCoordinates $mapCoordinates): BaseMapTile
    {
        return new BaseMapTile($tileId, $mapCoordinates);
    }

    public function createMapCoordinates(int $x, int $y): MapCoordinates
    {
        return new MapCoordinates($x, $y);
    }
}
