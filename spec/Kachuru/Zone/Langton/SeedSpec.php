<?php

namespace spec\Kachuru\Zone\Langton;

use Kachuru\Zone\Langton\MapTileState;
use Kachuru\Zone\Langton\Seed;
use Kachuru\Util\Combinations;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SeedSpec extends ObjectBehavior
{
    function it_works_out_transitions_mathematically_seed_0()
    {
        $this->beConstructedWith(0, new Combinations());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                $this->getStateHandle(MapTileState::TILE_STATE_ALPHA),
                $this->getStateHandle(MapTileState::TILE_STATE_BETA),
                $this->getStateHandle(MapTileState::TILE_STATE_GAMMA),
                $this->getStateHandle(MapTileState::TILE_STATE_DELTA),
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_1()
    {
        $this->beConstructedWith(1, new Combinations());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                $this->getStateHandle(MapTileState::TILE_STATE_ALPHA),
                $this->getStateHandle(MapTileState::TILE_STATE_BETA),
                $this->getStateHandle(MapTileState::TILE_STATE_DELTA),
                $this->getStateHandle(MapTileState::TILE_STATE_GAMMA),
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_6()
    {
        $this->beConstructedWith(6, new Combinations());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                $this->getStateHandle(MapTileState::TILE_STATE_BETA),
                $this->getStateHandle(MapTileState::TILE_STATE_GAMMA),
                $this->getStateHandle(MapTileState::TILE_STATE_DELTA),
                $this->getStateHandle(MapTileState::TILE_STATE_ALPHA),
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_7()
    {
        $this->beConstructedWith(7, new Combinations());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                $this->getStateHandle(MapTileState::TILE_STATE_BETA),
                $this->getStateHandle(MapTileState::TILE_STATE_GAMMA),
                $this->getStateHandle(MapTileState::TILE_STATE_ALPHA),
                $this->getStateHandle(MapTileState::TILE_STATE_DELTA),
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_16()
    {
        $this->beConstructedWith(16, new Combinations());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                $this->getStateHandle(MapTileState::TILE_STATE_GAMMA),
                $this->getStateHandle(MapTileState::TILE_STATE_BETA),
                $this->getStateHandle(MapTileState::TILE_STATE_DELTA),
                $this->getStateHandle(MapTileState::TILE_STATE_ALPHA),
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_17()
    {
        $this->beConstructedWith(17, new Combinations());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                $this->getStateHandle(MapTileState::TILE_STATE_GAMMA),
                $this->getStateHandle(MapTileState::TILE_STATE_BETA),
                $this->getStateHandle(MapTileState::TILE_STATE_ALPHA),
                $this->getStateHandle(MapTileState::TILE_STATE_DELTA),
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_20()
    {
        $this->beConstructedWith(20, new Combinations());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                $this->getStateHandle(MapTileState::TILE_STATE_DELTA),
                $this->getStateHandle(MapTileState::TILE_STATE_BETA),
                $this->getStateHandle(MapTileState::TILE_STATE_GAMMA),
                $this->getStateHandle(MapTileState::TILE_STATE_ALPHA),
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_21()
    {
        $this->beConstructedWith(21, new Combinations());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                $this->getStateHandle(MapTileState::TILE_STATE_DELTA),
                $this->getStateHandle(MapTileState::TILE_STATE_BETA),
                $this->getStateHandle(MapTileState::TILE_STATE_ALPHA),
                $this->getStateHandle(MapTileState::TILE_STATE_GAMMA),
            ]
        );
    }

    private function getStateHandle(int $state): string
    {
        return MapTileState::TILE_STATE_HANDLES[$state];
    }
}
