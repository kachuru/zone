<?php

namespace spec\Kachuru\Zone\Langton;

use Kachuru\MapMaker\MapCoordinates;
use Kachuru\MapMaker\BaseMapTile;
use Kachuru\Zone\Langton\MapTileWithState;
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
