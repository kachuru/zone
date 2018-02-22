<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\HexagonalMap;
use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\MapTile;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HexagonalMapSpec extends ObjectBehavior
{
    function its_a_map()
    {
        $mapTiles = $this->getMapWithSevenTiles();

        $this->beConstructedWith($mapTiles);

        $this->getMapTiles()->shouldReturn($mapTiles);
    }

    public function it_gets_map_tile_by_id()
    {
        $mapTiles = $this->getMapWithSevenTiles();

        $this->beConstructedWith($mapTiles);

        $this->getMapTileById('T1')->shouldReturn($mapTiles[0]);
        $this->getMapTileById('T4')->shouldReturn($mapTiles[3]);
    }

    public function it_gets_map_tile_by_coordinates()
    {
        $mapTiles = $this->getMapWithSevenTiles();

        $this->beConstructedWith($mapTiles);

        $this->getMapTileByCoordinates(new MapCoordinates(1, 1))->shouldReturn($mapTiles[0]);
        $this->getMapTileByCoordinates(new MapCoordinates(2, 1))->shouldReturn($mapTiles[1]);
        $this->getMapTileByCoordinates(new MapCoordinates(2, 4))->shouldReturn($mapTiles[4]);
    }

    private function getMapWithSevenTiles()
    {
        return [
            new MapTile('T1', new MapCoordinates(1, 1)),
            new MapTile('T2', new MapCoordinates(2, 1)),
            new MapTile('T3', new MapCoordinates(2, 2)),
            new MapTile('T4', new MapCoordinates(2, 3)),
            new MapTile('T5', new MapCoordinates(2, 4)),
            new MapTile('T6', new MapCoordinates(2, 5)),
            new MapTile('T7', new MapCoordinates(2, 6)),
        ];
    }
}
