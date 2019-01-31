<?php

namespace Kachuru\Twig\Zone\Map;

use Kachuru\Zone\Map\MapCoordinates;
use Twig\Extension\RuntimeExtensionInterface;

class TilePosition implements RuntimeExtensionInterface
{
    private $xOffset;
    private $yOffset;

    public function __construct(int $xOffset, int $yOffset)
    {
        $this->xOffset = $xOffset;
        $this->yOffset = $yOffset;
    }

    public function getXPosition(MapCoordinates $coordinates): int
    {
        return $coordinates->getX() * $this->xOffset;
    }

    public function getYPosition(MapCoordinates $coordinates): int
    {
        return $coordinates->getY() * $this->yOffset + $this->getXPositionAdditionalOffset($coordinates->getX());
    }

    protected function getXPositionAdditionalOffset(int $xCoordinate)
    {
        return $xCoordinate % 2 == 1
            ? $this->yOffset / 2
            : 0;
    }
}
