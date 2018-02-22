<?php

namespace Kachuru\Zone\Map;

class MapTileFactory
{
    private $idFormat;

    public function __construct(string $idFormat)
    {
        $this->idFormat = $idFormat;
    }

    public function createTile(int $tileNumber, MapCoordinates $mapCoordinates): MapTile
    {
        return new MapTile(sprintf($this->idFormat, $tileNumber), $mapCoordinates);
    }

    public function createMapCoordinates(int $radial, int $degree): MapCoordinates
    {
        return new MapCoordinates($radial, $degree);
    }
}
