<?php

namespace spec\Kachuru\Zone\Langton;

use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Map\Map;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AntStateSpec extends ObjectBehavior
{
    function it_returns_the_correct_next_orientation()
    {
        $this->beConstructedWith(Map::DIRECTION_SOUTH);
        $this->getOrientation()->shouldReturn(Map::DIRECTION_SOUTH);
        $this->getOrientationHandle()->shouldReturn('s');
        $this->getClockwiseOrientation()->shouldReturn(Map::DIRECTION_SOUTHWEST);
        $this->getAnticlockwiseOrientation()->shouldReturn(Map::DIRECTION_SOUTHEAST);
    }

    function it_returns_the_correct_orientation_cross_boundary_cw()
    {
        $this->beConstructedWith(Map::DIRECTION_NORTHWEST);
        $this->getOrientation()->shouldReturn(Map::DIRECTION_NORTHWEST);
        $this->getOrientationHandle()->shouldReturn('nw');
        $this->getClockwiseOrientation()->shouldReturn(Map::DIRECTION_NORTH);
    }

    function it_returns_the_correct_orientation_cross_boundary_acw()
    {
        $this->beConstructedWith(Map::DIRECTION_NORTH);
        $this->getOrientation()->shouldReturn(Map::DIRECTION_NORTH);
        $this->getOrientationHandle()->shouldReturn('n');
        $this->getAnticlockwiseOrientation()->shouldReturn(Map::DIRECTION_NORTHWEST);
    }
}
