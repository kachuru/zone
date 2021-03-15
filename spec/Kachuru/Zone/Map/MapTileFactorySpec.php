<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\BaseMapTile;
use Kachuru\Zone\Map\MapTileFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MapTileFactorySpec extends ObjectBehavior
{
    function it_creates_a_map_tile()
    {
        $this->createTile(1, new MapCoordinates(1, 1))->shouldBeLike(new BaseMapTile('1', new MapCoordinates(1, 1)));
        $this->createTile(2, new MapCoordinates(1, 2))->shouldBeLike(new BaseMapTile('2', new MapCoordinates(1, 2)));
        $this->createTile(3, new MapCoordinates(1, 3))->shouldBeLike(new BaseMapTile('3', new MapCoordinates(1, 3)));
    }

    function it_makes_map_coordinates()
    {
        $this->createMapCoordinates(1, 1)->shouldBeLike(new MapCoordinates(1, 1));
        $this->createMapCoordinates(4, 7)->shouldBeLike(new MapCoordinates(4, 7));
    }
}
