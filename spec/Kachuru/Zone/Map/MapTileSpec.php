<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\MapTile;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MapTileSpec extends ObjectBehavior
{
    function it_is_a_map_tile()
    {
        $this->beConstructedWith('T1', new MapCoordinates(1, 1));

        $this->getTileId()->shouldReturn('T1');
    }
}
