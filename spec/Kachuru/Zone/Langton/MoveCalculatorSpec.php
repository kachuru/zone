<?php

namespace spec\Kachuru\Zone\Langton;

use Kachuru\Util\Combinations;
use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\LangtonMove;
use Kachuru\Zone\Langton\MoveCalculator;
use Kachuru\Zone\Langton\Seed;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnFactory;
use Kachuru\Zone\Langton\Transition\TransitionHandler;
use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\MapSize;
use Kachuru\Zone\Map\MapStencil;
use Kachuru\Zone\Map\MapTile;
use Kachuru\Zone\Map\MapTileFactory;
use Kachuru\Zone\Map\MapTileState;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoveCalculatorSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            new MapStencil(new MapSize(4, 3), new MapTileFactory()),
            new TransitionHandler(new Seed(10000000, new Combinations(), new AntTurnFactory()))
        );
    }

    function it_returns_the_correct_next_move()
    {
        $currentMapTile = new MapTile(5, new MapCoordinates(1, 1));

        $this->getMove(
            new MapTileState($currentMapTile, MapTileState::TILE_STATE_ALPHA),
            new AntState(Map::DIRECTION_NORTH)
        )->shouldBeLike(new LangtonMove(
            new AntState(Map::DIRECTION_NORTHEAST),
            new MapTile(6, new MapCoordinates(2, 1)),
            new MapTileState($currentMapTile, MapTileState::TILE_STATE_BETA)
        ));

        $this->getMove(
            new MapTileState($currentMapTile, MapTileState::TILE_STATE_BETA),
            new AntState(Map::DIRECTION_NORTH)
        )->shouldBeLike(new LangtonMove(
            new AntState(Map::DIRECTION_NORTHWEST),
            new MapTile(4, new MapCoordinates(0, 1)),
            new MapTileState($currentMapTile, MapTileState::TILE_STATE_GAMMA)
        ));

        $this->getMove(
            new MapTileState($currentMapTile, MapTileState::TILE_STATE_GAMMA),
            new AntState(Map::DIRECTION_NORTH)
        )->shouldBeLike(new LangtonMove(
            new AntState(Map::DIRECTION_SOUTHEAST),
            new MapTile(10, new MapCoordinates(2, 2)),
            new MapTileState($currentMapTile, MapTileState::TILE_STATE_DELTA)
        ));

        $this->getMove(
            new MapTileState($currentMapTile, MapTileState::TILE_STATE_DELTA),
            new AntState(Map::DIRECTION_NORTH)
        )->shouldBeLike(new LangtonMove(
            new AntState(Map::DIRECTION_SOUTHWEST),
            new MapTile(8, new MapCoordinates(0, 2)),
            new MapTileState($currentMapTile, MapTileState::TILE_STATE_ALPHA)
        ));
    }

    function it_throws_exception_if_ant_goes_out_of_bounds()
    {
        $currentMapTile = new MapTile(2, new MapCoordinates(2, 0));

        $this->shouldThrow('\RuntimeException')->duringGetMove(
            new MapTileState($currentMapTile, MapTileState::TILE_STATE_ALPHA),
            new AntState(Map::DIRECTION_NORTHWEST)
        );
    }
}
