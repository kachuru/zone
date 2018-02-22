<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\MapTile;
use Kachuru\Zone\Map\MapTileFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MapTileFactorySpec extends ObjectBehavior
{
    function it_creates_a_map_tile()
    {
        $this->beConstructedWith('test-%d');

        $this->createTile(1, new MapCoordinates(1, 1))->shouldBeLike(new MapTile('test-1', new MapCoordinates(1, 1)));
        $this->createTile(2, new MapCoordinates(1, 2))->shouldBeLike(new MapTile('test-2', new MapCoordinates(1, 2)));
        $this->createTile(3, new MapCoordinates(1, 3))->shouldBeLike(new MapTile('test-3', new MapCoordinates(1, 3)));
    }
}
