<?php

namespace Kachuru\Zone\Twig\Map;

use Kachuru\MapMaker\MapCoordinates;
use Twig\Extension\RuntimeExtensionInterface;

readonly class TilePosition implements RuntimeExtensionInterface
{
    public function __construct(
        private int $xOffset,
        private int $yOffset
    ) {
    }

    public function getXPosition(MapCoordinates $coordinates): int
    {
        return $coordinates->getX() * $this->xOffset;
    }

    public function getYPosition(MapCoordinates $coordinates): int
    {
        return $coordinates->getY() * $this->yOffset + $this->getXPositionAdditionalOffset($coordinates->getX());
    }

    protected function getXPositionAdditionalOffset(int $xCoordinate): int
    {
        return $xCoordinate % 2 == 1 ? $this->yOffset / 2 : 0;
    }
}
