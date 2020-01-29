<?php

namespace Kachuru\Zone\Map;

class MapFactory
{
    private $map;

    public function __construct(MapStencil $map)
    {
        $this->map = $map;
    }

    public function getMap(): Map
    {
        return $this->map;
    }
}