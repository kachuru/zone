<?php

namespace spec\Kachuru\Zone\Dto\Langton;

use Kachuru\Zone\Dto\Langton\LangtonMove;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LangtonMoveSpec extends ObjectBehavior
{
    function it_does_the_job()
    {
        $this->beConstructedWith('north', 1, 2, 'epsilon');

        $this->getAntStateOrientation()->shouldReturn('north');
        $this->getAntStateLocation()->shouldReturn(1);
        $this->getUpdateTileLocation()->shouldReturn(2);
        $this->getUpdateTileState()->shouldReturn('epsilon');
    }
}
