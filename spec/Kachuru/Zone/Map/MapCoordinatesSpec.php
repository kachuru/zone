<?php

namespace spec\Kachuru\Zone\Map;

use Kachuru\Zone\Map\MapCoordinates;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MapCoordinatesSpec extends ObjectBehavior
{
    function it_returns_the_correct_coordinates()
    {
        $this->beConstructedWith(4, 7);

        $this->getX()->shouldReturn(4);
        $this->getY()->shouldReturn(7);

        $this->__toString()->shouldReturn('4:7');
    }
}
