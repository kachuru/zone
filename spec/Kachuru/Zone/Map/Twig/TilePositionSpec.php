<?php

namespace spec\Kachuru\Zone\Map\Twig;

use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\Twig\TilePosition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TilePositionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(2, 2);
    }

    function it_returns_the_correct_x_position()
    {
        $this->getXPosition(new MapCoordinates(4, 7))->shouldReturn(8);
    }

    function it_returns_the_correct_y_position()
    {
        $this->getYPosition(new MapCoordinates(4, 7))->shouldReturn(14);
        $this->getYPosition(new MapCoordinates(5, 7))->shouldReturn(15);
    }
}
