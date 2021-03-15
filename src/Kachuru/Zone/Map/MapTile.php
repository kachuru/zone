<?php

namespace Kachuru\Zone\Map;

interface MapTile
{
    public function getTileId(): int;

    public function getCoordinates(): MapCoordinates;
}
