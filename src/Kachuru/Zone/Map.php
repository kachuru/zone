<?php

namespace Kachuru\Zone;

class Map
{
    private $map;

    public function __construct(MapProvider $mapProvider)
    {
        $this->map = $mapProvider->asArray();
    }

    public function getCell(array $coords)
    {
        return $this->map[implode(':', $coords)];
    }

    public function getAdjacentCells(array $coords)
    {
        return [
            $this->getCell([$coords[0] - 1, $coords[1] - 1]),
            $this->getCell([$coords[0] - 1, $coords[1]]),
            $this->getCell([$coords[0], $coords[1] - 1]),
            $this->getCell([$coords[0], $coords[1] + 1]),
            $this->getCell([$coords[0] + 1, $coords[1] - 1]),
            $this->getCell([$coords[0] + 1, $coords[1]]),
        ];
    }
}
