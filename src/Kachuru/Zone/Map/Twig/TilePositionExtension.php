<?php

namespace Kachuru\Zone\Map\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TilePositionExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            // the logic of this filter is now implemented in a different class
            new TwigFilter('xpos', [TilePosition::class, 'getXPosition']),
            new TwigFilter('ypos', [TilePosition::class, 'getYPosition']),
        ];
    }
}
