<?php

namespace spec\Kachuru\Zone\Langton;

use Kachuru\Zone\Langton\MoveStrategy;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MoveStrategySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(MoveStrategy::class);
    }
}
