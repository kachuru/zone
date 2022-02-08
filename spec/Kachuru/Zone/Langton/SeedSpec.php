<?php

namespace spec\Kachuru\Zone\Langton;

use Kachuru\Util\Math;
use Kachuru\Zone\Langton\Seed;
use Kachuru\Util\Combinations;
use Kachuru\Zone\Langton\MapTileWithState;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SeedSpec extends ObjectBehavior
{
    function it_works_out_transitions_mathematically_seed_0()
    {
        $this->beConstructedWith(10000000, new Combinations(new Math()), new AntTurnFactory());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                MapTileWithState::TILE_STATE_ALPHA,
                MapTileWithState::TILE_STATE_BETA,
                MapTileWithState::TILE_STATE_GAMMA,
                MapTileWithState::TILE_STATE_DELTA,
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_1()
    {
        $this->beConstructedWith(10000100, new Combinations(new Math()), new AntTurnFactory());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                MapTileWithState::TILE_STATE_ALPHA,
                MapTileWithState::TILE_STATE_BETA,
                MapTileWithState::TILE_STATE_DELTA,
                MapTileWithState::TILE_STATE_GAMMA,
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_6()
    {
        $this->beConstructedWith(10000600, new Combinations(new Math()), new AntTurnFactory());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                MapTileWithState::TILE_STATE_BETA,
                MapTileWithState::TILE_STATE_GAMMA,
                MapTileWithState::TILE_STATE_DELTA,
                MapTileWithState::TILE_STATE_ALPHA,
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_7()
    {
        $this->beConstructedWith(10000700, new Combinations(new Math()), new AntTurnFactory());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                MapTileWithState::TILE_STATE_BETA,
                MapTileWithState::TILE_STATE_GAMMA,
                MapTileWithState::TILE_STATE_ALPHA,
                MapTileWithState::TILE_STATE_DELTA,
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_16()
    {
        $this->beConstructedWith(10001600, new Combinations(new Math()), new AntTurnFactory());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                MapTileWithState::TILE_STATE_GAMMA,
                MapTileWithState::TILE_STATE_BETA,
                MapTileWithState::TILE_STATE_DELTA,
                MapTileWithState::TILE_STATE_ALPHA,
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_17()
    {
        $this->beConstructedWith(10001700, new Combinations(new Math()), new AntTurnFactory());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                MapTileWithState::TILE_STATE_GAMMA,
                MapTileWithState::TILE_STATE_BETA,
                MapTileWithState::TILE_STATE_ALPHA,
                MapTileWithState::TILE_STATE_DELTA,
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_20()
    {
        $this->beConstructedWith(10002000, new Combinations(new Math()), new AntTurnFactory());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                MapTileWithState::TILE_STATE_DELTA,
                MapTileWithState::TILE_STATE_BETA,
                MapTileWithState::TILE_STATE_GAMMA,
                MapTileWithState::TILE_STATE_ALPHA,
            ]
        );
    }

    function it_works_out_transitions_mathematically_seed_21()
    {
        $this->beConstructedWith(10002100, new Combinations(new Math()), new AntTurnFactory());

        $this->getMapTileStateTransitionOrder()->shouldBeLike(
            [
                MapTileWithState::TILE_STATE_DELTA,
                MapTileWithState::TILE_STATE_BETA,
                MapTileWithState::TILE_STATE_ALPHA,
                MapTileWithState::TILE_STATE_GAMMA,
            ]
        );
    }

    function it_returns_the_correct_first_state()
    {
        $this->beConstructedWith(10000000, new Combinations(new Math()), new AntTurnFactory());

        $this->getFirstState()->shouldReturn(MapTileWithState::TILE_STATE_ALPHA);
    }
}
