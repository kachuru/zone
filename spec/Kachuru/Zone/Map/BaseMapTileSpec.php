<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\BaseMapTile;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BaseMapTileSpec extends ObjectBehavior
{
    function it_is_a_map_tile()
    {
        $coordinates = new MapCoordinates(1, 1);

        $this->beConstructedWith(1, $coordinates);

        $this->getTileId()->shouldReturn(1);
        $this->getCoordinates()->shouldReturn($coordinates);
    }
}
