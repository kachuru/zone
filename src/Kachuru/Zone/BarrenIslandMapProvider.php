<?php

namespace Kachuru\Zone;

class BarrenIslandMapProvider implements MapProvider
{
    private $width;
    private $height;

    public function __construct($size)
    {
        $this->width = $size * 2 - 1;
        $this->height = $size * 2 - 1;
    }

    public function asArray(): array
    {
        $mapGrid = [];

        for ($y = 0; $y < $this->height; $y++) {
            $mapGrid = array_merge($mapGrid, $this->generateRow($y));
        }

        return $mapGrid;
    }

    private function generateRow($y)
    {
        $row = [];
        for ($x = 0; $x < $this->width; $x++) {
            $row[sprintf('%s:%s', $x, $y)] = $this->generateCell($y, $x);
        }
        return $row;
    }

    private function generateCell($y, $x)
    {
        $terrain = MapTerrain::TYPE_BARREN;

        if ($this->isAnEdgeCell($y, $x)) {
            $terrain = MapTerrain::TYPE_WATER;
        }

        return new MapCell($x, $y, $terrain);
    }

    private function isAnEdgeCell($y, $x)
    {
        return in_array($y, [0, $this->getLastCell($this->height)])
            || in_array($x, [0, $this->getLastCell($this->width)]);
    }

    private function getLastCell($length)
    {
        return $length - 1;
    }
}
