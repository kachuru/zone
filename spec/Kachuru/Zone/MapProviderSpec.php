<?php

namespace spec\Kachuru\Zone;

use Kachuru\Zone\MapCell;
use Kachuru\Zone\BarrenIslandMapProvider;
use Kachuru\Zone\MapTerrain;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class BarrenIslandMapProviderSpec
 * @package spec\Kachuru\Zone
 * @mixin BarrenIslandMapProvider
 */
class BarrenIslandMapProviderSpec extends ObjectBehavior
{
    function it_returns_a_five_by_five_grid()
    {
        $this->beConstructedWith(3);

        $this->asArray()->shouldBeLike(
            [
                "0:0" => new MapCell(0, 0, MapTerrain::TYPE_WATER),
                "1:0" => new MapCell(1, 0, MapTerrain::TYPE_WATER),
                "2:0" => new MapCell(2, 0, MapTerrain::TYPE_WATER),
                "3:0" => new MapCell(3, 0, MapTerrain::TYPE_WATER),
                "4:0" => new MapCell(4, 0, MapTerrain::TYPE_WATER),

                "0:1" => new MapCell(0, 1, MapTerrain::TYPE_WATER),
                "1:1" => new MapCell(1, 1, MapTerrain::TYPE_BARREN),
                "2:1" => new MapCell(2, 1, MapTerrain::TYPE_BARREN),
                "3:1" => new MapCell(3, 1, MapTerrain::TYPE_BARREN),
                "4:1" => new MapCell(4, 1, MapTerrain::TYPE_WATER),

                "0:2" => new MapCell(0, 2, MapTerrain::TYPE_WATER),
                "1:2" => new MapCell(1, 2, MapTerrain::TYPE_BARREN),
                "2:2" => new MapCell(2, 2, MapTerrain::TYPE_BARREN),
                "3:2" => new MapCell(3, 2, MapTerrain::TYPE_BARREN),
                "4:2" => new MapCell(4, 2, MapTerrain::TYPE_WATER),

                "0:3" => new MapCell(0, 3, MapTerrain::TYPE_WATER),
                "1:3" => new MapCell(1, 3, MapTerrain::TYPE_BARREN),
                "2:3" => new MapCell(2, 3, MapTerrain::TYPE_BARREN),
                "3:3" => new MapCell(3, 3, MapTerrain::TYPE_BARREN),
                "4:3" => new MapCell(4, 3, MapTerrain::TYPE_WATER),

                "0:4" => new MapCell(0, 4, MapTerrain::TYPE_WATER),
                "1:4" => new MapCell(1, 4, MapTerrain::TYPE_WATER),
                "2:4" => new MapCell(2, 4, MapTerrain::TYPE_WATER),
                "3:4" => new MapCell(3, 4, MapTerrain::TYPE_WATER),
                "4:4" => new MapCell(4, 4, MapTerrain::TYPE_WATER),
            ]
        );
    }
}
