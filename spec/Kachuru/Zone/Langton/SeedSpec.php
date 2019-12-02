<?php

namespace spec\Kachuru\Zone\Langton;

use Kachuru\Zone\Langton\MapTileState;
use Kachuru\Zone\Langton\Seed;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SeedSpec extends ObjectBehavior
{
    function it_returns_state_order_based_on_seed_0()
    {
        $this->beConstructedWith(0);

        $this->getMapTileStateTransitions()->shouldBeLike(
            [
                MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_ALPHA],
                MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_BETA],
                MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_GAMMA],
                MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_DELTA],
            ]
        );
    }

    function it_gets_all_the_transitions()
    {
        $this->beConstructedWith(0);

        $this->getAllTransitions()->shouldReturn(
            [
                ['alpha', 'beta', 'gamma', 'delta'], //  0
                ['alpha', 'beta', 'delta', 'gamma'], //  1
                ['alpha', 'gamma', 'delta', 'beta'], //  2
                ['alpha', 'gamma', 'beta', 'delta'], //  3
                ['alpha', 'delta', 'beta', 'gamma'], //  4
                ['alpha', 'delta', 'gamma', 'beta'], //  5

                ['beta', 'gamma', 'delta', 'alpha'], //  6
                ['beta', 'gamma', 'alpha', 'delta'], //  7
                ['beta', 'delta', 'alpha', 'gamma'], //  8
                ['beta', 'delta', 'gamma', 'alpha'], //  9
                ['beta', 'alpha', 'gamma', 'delta'], // 10
                ['beta', 'alpha', 'delta', 'gamma'], // 11

                ['gamma', 'delta', 'alpha', 'beta'], // 12
                ['gamma', 'delta', 'beta', 'alpha'], // 13
                ['gamma', 'alpha', 'beta', 'delta'], // 14
                ['gamma', 'alpha', 'delta', 'beta'], // 15
                ['gamma', 'beta', 'delta', 'alpha'], // 16
                ['gamma', 'beta', 'alpha', 'delta'], // 17

                ['delta', 'alpha', 'beta', 'gamma'], // 18
                ['delta', 'alpha', 'gamma', 'beta'], // 19
                ['delta', 'beta', 'gamma', 'alpha'], // 20
                ['delta', 'beta', 'alpha', 'gamma'], // 21
                ['delta', 'gamma', 'alpha', 'beta'], // 22
                ['delta', 'gamma', 'beta', 'alpha'], // 23
            ]
        );
    }
}
