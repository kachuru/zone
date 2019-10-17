<?php

namespace Kachuru\Zone\Map;

interface MapBuilder
{
    public function build(MapSize $mapSize): Map;
}
