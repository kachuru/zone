<?php

namespace spec\Kachuru\Zone;

use Kachuru\Zone\Map;
use Kachuru\Zone\MapCell;
use Kachuru\Zone\BarrenIslandMapProvider;
use Kachuru\Zone\MapTerrain;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin Map
 */
class MapSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new BarrenIslandMapProvider(3));
    }

    function it_returns_cell()
    {
        $this->getCell([2, 2])->shouldBeLike(
            new MapCell(2, 2, MapTerrain::TYPE_BARREN)
        );
    }

    function it_returns_adjacent_cells()
    {
        $this->getAdjacentCells([2, 2])->shouldBeLike(
            [
                new MapCell(1, 1, MapTerrain::TYPE_BARREN),
                new MapCell(1, 2, MapTerrain::TYPE_BARREN),
                new MapCell(2, 1, MapTerrain::TYPE_BARREN),
                new MapCell(2, 3, MapTerrain::TYPE_BARREN),
                new MapCell(3, 1, MapTerrain::TYPE_BARREN),
                new MapCell(3, 2, MapTerrain::TYPE_BARREN),
            ]
        );
    }
}
