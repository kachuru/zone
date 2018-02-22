<?php

namespace Kachuru\Zone\Map;

interface MapBuilder
{
    public function build(int $size): HexagonalMap;
}
