<?php

namespace Kachuru\Zone\Twig\Map;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TilePositionExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('xpos', [TilePosition::class, 'getXPosition']),
            new TwigFilter('ypos', [TilePosition::class, 'getYPosition']),
        ];
    }
}
