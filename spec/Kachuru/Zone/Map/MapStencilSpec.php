<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\MapSize;
use Kachuru\Zone\Map\MapStencil;
use Kachuru\Zone\Map\MapTileFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MapStencilSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            new MapSize(4, 3),
            new MapTileFactory('T%d')
        );
    }

    function it_returns_the_set_of_map_tiles()
    {

    }
}
