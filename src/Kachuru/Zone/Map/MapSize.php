<?php

namespace Kachuru\Zone\Map;

class MapSize
{
    private $xSize;
    private $ySize;

    public function __construct(int $xSize, int $ySize)
    {
        $this->xSize = $xSize;
        $this->ySize = $ySize;
    }

    public function getXSize(): int
    {
        return $this->xSize;
    }

    public function getYSize(): int
    {
        return $this->ySize;
    }
}
