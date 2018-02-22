<?php

namespace Kachuru\Zone\Map;

class MapTile
{
    private $tileId;

    private $mapCoordinates;

    public function __construct(string $tileId, MapCoordinates $mapCoordinates)
    {
        $this->tileId = $tileId;
        $this->mapCoordinates = $mapCoordinates;
    }

    public function getTileId(): string
    {
        return $this->tileId;
    }

    public function getCoordinates(): MapCoordinates
    {
        return $this->mapCoordinates;
    }
}
