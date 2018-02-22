<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\HexagonalMap;
use Kachuru\Zone\Map\HexagonalMapBuilder;
use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\MapTile;
use Kachuru\Zone\Map\MapTileFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HexagonalMapBuilderSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new MapTileFactory('T%d'));
    }

    function it_returns_the_correct_number_of_tiles_to_generate()
    {
        $this->getNumberOfTilesFromSize(1)->shouldReturn(1);
        $this->getNumberOfTilesFromSize(2)->shouldReturn(7);
        $this->getNumberOfTilesFromSize(3)->shouldReturn(19);
        $this->getNumberOfTilesFromSize(4)->shouldReturn(37);
        $this->getNumberOfTilesFromSize(5)->shouldReturn(61);
        $this->getNumberOfTilesFromSize(6)->shouldReturn(91);
        $this->getNumberOfTilesFromSize(7)->shouldReturn(127);
        $this->getNumberOfTilesFromSize(8)->shouldReturn(169);
    }

    function it_returns_correct_map_coordinates_from_tile_number()
    {
        $this->getMapCoordinatesByTileNumber(1)->shouldBeLike(new MapCoordinates(1, 1));
        $this->getMapCoordinatesByTileNumber(4)->shouldBeLike(new MapCoordinates(2, 3));
        $this->getMapCoordinatesByTileNumber(12)->shouldBeLike(new MapCoordinates(3, 5));
    }

    function it_builds_a_static_map()
    {
        $this->build(1)->shouldBeLike(
            new HexagonalMap([
                new MapTile('T1', new MapCoordinates(1, 1))
            ])
        );

        $this->build(2)->shouldBeLike(
            new HexagonalMap([
                new MapTile('T1', new MapCoordinates(1, 1)),
                new MapTile('T2', new MapCoordinates(2, 1)),
                new MapTile('T3', new MapCoordinates(2, 2)),
                new MapTile('T4', new MapCoordinates(2, 3)),
                new MapTile('T5', new MapCoordinates(2, 4)),
                new MapTile('T6', new MapCoordinates(2, 5)),
                new MapTile('T7', new MapCoordinates(2, 6)),
            ])
        );

        $this->build(5)->shouldBeLike(
            new HexagonalMap([
                new MapTile('T1', new MapCoordinates(1, 1)),

                new MapTile('T2', new MapCoordinates(2, 1)),
                new MapTile('T3', new MapCoordinates(2, 2)),
                new MapTile('T4', new MapCoordinates(2, 3)),
                new MapTile('T5', new MapCoordinates(2, 4)),
                new MapTile('T6', new MapCoordinates(2, 5)),
                new MapTile('T7', new MapCoordinates(2, 6)),

                new MapTile('T8', new MapCoordinates(3, 1)),
                new MapTile('T9', new MapCoordinates(3, 2)),
                new MapTile('T10', new MapCoordinates(3, 3)),
                new MapTile('T11', new MapCoordinates(3, 4)),
                new MapTile('T12', new MapCoordinates(3, 5)),
                new MapTile('T13', new MapCoordinates(3, 6)),
                new MapTile('T14', new MapCoordinates(3, 7)),
                new MapTile('T15', new MapCoordinates(3, 8)),
                new MapTile('T16', new MapCoordinates(3, 9)),
                new MapTile('T17', new MapCoordinates(3, 10)),
                new MapTile('T18', new MapCoordinates(3, 11)),
                new MapTile('T19', new MapCoordinates(3, 12)),

                new MapTile('T20', new MapCoordinates(4, 1)),
                new MapTile('T21', new MapCoordinates(4, 2)),
                new MapTile('T22', new MapCoordinates(4, 3)),
                new MapTile('T23', new MapCoordinates(4, 4)),
                new MapTile('T24', new MapCoordinates(4, 5)),
                new MapTile('T25', new MapCoordinates(4, 6)),
                new MapTile('T26', new MapCoordinates(4, 7)),
                new MapTile('T27', new MapCoordinates(4, 8)),
                new MapTile('T28', new MapCoordinates(4, 9)),
                new MapTile('T29', new MapCoordinates(4, 10)),
                new MapTile('T30', new MapCoordinates(4, 11)),
                new MapTile('T31', new MapCoordinates(4, 12)),
                new MapTile('T32', new MapCoordinates(4, 13)),
                new MapTile('T33', new MapCoordinates(4, 14)),
                new MapTile('T34', new MapCoordinates(4, 15)),
                new MapTile('T35', new MapCoordinates(4, 16)),
                new MapTile('T36', new MapCoordinates(4, 17)),
                new MapTile('T37', new MapCoordinates(4, 18)),

                new MapTile('T38', new MapCoordinates(5, 1)),
                new MapTile('T39', new MapCoordinates(5, 2)),
                new MapTile('T40', new MapCoordinates(5, 3)),
                new MapTile('T41', new MapCoordinates(5, 4)),
                new MapTile('T42', new MapCoordinates(5, 5)),
                new MapTile('T43', new MapCoordinates(5, 6)),
                new MapTile('T44', new MapCoordinates(5, 7)),
                new MapTile('T45', new MapCoordinates(5, 8)),
                new MapTile('T46', new MapCoordinates(5, 9)),
                new MapTile('T47', new MapCoordinates(5, 10)),
                new MapTile('T48', new MapCoordinates(5, 11)),
                new MapTile('T49', new MapCoordinates(5, 12)),
                new MapTile('T50', new MapCoordinates(5, 13)),
                new MapTile('T51', new MapCoordinates(5, 14)),
                new MapTile('T52', new MapCoordinates(5, 15)),
                new MapTile('T53', new MapCoordinates(5, 16)),
                new MapTile('T54', new MapCoordinates(5, 17)),
                new MapTile('T55', new MapCoordinates(5, 18)),
                new MapTile('T56', new MapCoordinates(5, 19)),
                new MapTile('T57', new MapCoordinates(5, 20)),
                new MapTile('T58', new MapCoordinates(5, 21)),
                new MapTile('T59', new MapCoordinates(5, 22)),
                new MapTile('T60', new MapCoordinates(5, 23)),
                new MapTile('T61', new MapCoordinates(5, 24)),
            ])
        );
    }
}
