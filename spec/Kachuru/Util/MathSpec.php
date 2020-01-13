<?php

namespace spec\Kachuru\Util;

use Kachuru\Util\Math;
use PhpSpec\ObjectBehavior;

class MathSpec extends ObjectBehavior
{
    function it_returns_the_correct_factorial()
    {
        $this->getFactorial(1)->shouldReturn(1);
        $this->getFactorial(2)->shouldReturn(2);
        $this->getFactorial(3)->shouldReturn(6);
        $this->getFactorial(4)->shouldReturn(24);
        $this->getFactorial(5)->shouldReturn(120);
    }
}
