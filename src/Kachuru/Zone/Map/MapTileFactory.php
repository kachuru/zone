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
        return new MapTile($this->generateId($tileNumber), $mapCoordinates);
    }

    public function createMapCoordinates(int $radial, int $degree): MapCoordinates
    {
        return new MapCoordinates($radial, $degree);
    }

    protected function generateId(int $tileNumber): string
    {
        return sprintf($this->idFormat, $tileNumber);
    }
}
