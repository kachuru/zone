<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\MapTile;
use Kachuru\Zone\Map\MapTileState;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MapTileStateSpec extends ObjectBehavior
{
    function it_returns_the_correct_data()
    {
        $mapCoordinates = new MapCoordinates(1, 1);
        $mapTile = new MapTile(1, $mapCoordinates);
        $this->beConstructedWith($mapTile, MapTileState::TILE_STATE_ALPHA);

        $this->getMapTile()->shouldReturn($mapTile);
        $this->getMapTileId()->shouldReturn(1);
        $this->getMapTileCoordinates()->shouldReturn($mapCoordinates);
        $this->getState()->shouldReturn(MapTileState::TILE_STATE_ALPHA);
        $this->getStateHandle()->shouldReturn('alpha');
    }
}
