<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\MapSize;
use Kachuru\Zone\Map\MapStencil;
use Kachuru\Zone\Map\BaseMapTile;
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

    function it_returns_the_correct_adjacent_tiles_on_a_bigger_map()
    {
        $this->beConstructedWith(
            new MapSize(80, 60),
            new MapTileFactory()
        );

        $this->getAdjacentTiles(new MapCoordinates(15, 20))->shouldIterateLike(
            new \ArrayIterator(
                [
                    $this->makeTile(1535, 15, 19),
                    $this->makeTile(1616, 16, 20),
                    $this->makeTile(1696, 16, 21),
                    $this->makeTile(1695, 15, 21),
                    $this->makeTile(1694, 14, 21),
                    $this->makeTile(1614, 14, 20),
                ]
            )
        );
    }

    function it_returns_the_correct_centre_tile()
    {
        $this->getCentreTile()->shouldBeLike($this->makeTile(5, 1, 1));
    }

    function it_returns_the_correct_centre_tile_again()
    {
        $this->beConstructedWith(
            new MapSize(5, 5),
            new MapTileFactory()
        );

        $this->getCentreTile()->shouldBeLike($this->makeTile(12, 2, 2));
    }

    function it_returns_map_tile_in_direction()
    {
        $this->getMapTileInDirection(new MapCoordinates(2, 1), Map::DIRECTION_NORTH)->shouldBeLike($this->makeTile(2, 2, 0));
        $this->getMapTileInDirection(new MapCoordinates(2, 1), Map::DIRECTION_NORTHEAST)->shouldBeLike($this->makeTile(3, 3, 0));
        $this->getMapTileInDirection(new MapCoordinates(2, 1), Map::DIRECTION_SOUTHEAST)->shouldBeLike($this->makeTile(7, 3, 1));
        $this->getMapTileInDirection(new MapCoordinates(2, 1), Map::DIRECTION_SOUTH)->shouldBeLike($this->makeTile(10, 2, 2));
        $this->getMapTileInDirection(new MapCoordinates(2, 1), Map::DIRECTION_SOUTHWEST)->shouldBeLike($this->makeTile(5, 1, 1));
        $this->getMapTileInDirection(new MapCoordinates(2, 1), Map::DIRECTION_NORTHWEST)->shouldBeLike($this->makeTile(1, 1, 0));
    }

    function it_throws_exception_for_invalid_tile()
    {
        $this->shouldThrow('\RunTimeException')->duringGetMapTileInDirection(new MapCoordinates(0, 0), Map::DIRECTION_NORTH);
    }

    private function makeTile($id, $x, $y): BaseMapTile
    {
        return new BaseMapTile($id, new MapCoordinates($x, $y));
    }
}
