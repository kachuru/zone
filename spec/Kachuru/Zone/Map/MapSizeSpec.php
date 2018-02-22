<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\MapSize;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MapSizeSpec extends ObjectBehavior
{
    function it_returns_the_correct_size()
    {
        $this->beConstructedWith(15, 10);

        $this->getXSize()->shouldReturn(15);
        $this->getYSize()->shouldReturn(10);
        $this->getSize()->shouldReturn(150);
    }
}
