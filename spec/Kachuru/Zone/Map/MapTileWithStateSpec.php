<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\BaseMapTile;
use Kachuru\Zone\Map\MapTileWithState;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MapTileWithStateSpec extends ObjectBehavior
{
    function it_returns_the_correct_data()
    {
        $mapCoordinates = new MapCoordinates(1, 1);
        $mapTile = new BaseMapTile(1, $mapCoordinates);
        $this->beConstructedWith($mapTile, MapTileWithState::TILE_STATE_ALPHA);

        $this->getMapTile()->shouldReturn($mapTile);
        $this->getTileId()->shouldReturn(1);
        $this->getCoordinates()->shouldReturn($mapCoordinates);
        $this->getState()->shouldReturn(MapTileWithState::TILE_STATE_ALPHA);
        $this->getStateHandle()->shouldReturn('alpha');
    }
}
