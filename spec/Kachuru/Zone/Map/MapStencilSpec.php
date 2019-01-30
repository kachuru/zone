<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\MapSize;
use Kachuru\Zone\Map\MapStencil;
use Kachuru\Zone\Map\MapTile;
use Kachuru\Zone\Map\MapTileFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MapStencilSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            new MapSize(4, 3),
            new MapTileFactory()
        );
    }

    function it_returns_map_tile_by_tile_id()
    {
        $this->getMapTileByTileId(6)->shouldBeLike(
            $this->makeTile(6, 2, 1)
        );
    }

    function it_returns_map_tile_by_coordinates()
    {
        $this->getMapTileByCoordinates(new MapCoordinates(0, 2))->shouldBeLike(
            $this->makeTile(8, 0, 2)
        );
    }

    function it_returns_the_set_of_map_tiles()
    {
        $this->getMapTiles()->shouldIterateLike(
            new \ArrayIterator(
                [
                    $this->makeTile(0, 0, 0),
                    $this->makeTile(1, 1, 0),
                    $this->makeTile(2, 2, 0),
                    $this->makeTile(3, 3, 0),
                    $this->makeTile(4, 0, 1),
                    $this->makeTile(5, 1, 1),
                    $this->makeTile(6, 2, 1),
                    $this->makeTile(7, 3, 1),
                    $this->makeTile(8, 0, 2),
                    $this->makeTile(9, 1, 2),
                    $this->makeTile(10, 2, 2),
                    $this->makeTile(11, 3, 2),
                ]
            )
        );
    }

    function it_returns_the_correct_adjacent_tiles()
    {
        $this->getAdjacentTiles(new MapCoordinates(1, 1))->shouldIterateLike(
            new \ArrayIterator(
                [
                    $this->makeTile(1, 1, 0),
                    $this->makeTile(6, 2, 1),
                    $this->makeTile(10, 2, 2),
                    $this->makeTile(9, 1, 2),
                    $this->makeTile(8, 0, 2),
                    $this->makeTile(4, 0, 1),
                ]
            )
        );

        $this->getAdjacentTiles(new MapCoordinates(2, 1))->shouldIterateLike(
            new \ArrayIterator(
                [
                    $this->makeTile(2, 2, 0),
                    $this->makeTile(3, 3, 0),
                    $this->makeTile(7, 3, 1),
                    $this->makeTile(10, 2, 2),
                    $this->makeTile(5, 1, 1),
                    $this->makeTile(1, 1, 0),
                ]
            )
        );
    }

    private function makeTile($id, $x, $y): MapTile
    {
        return new MapTile($id, new MapCoordinates($x, $y));
    }
}
