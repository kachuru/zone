<?php

namespace spec\Kachuru\Zone\Langton;

use Kachuru\Zone\Langton\TransitionsCalculator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransitionsCalculatorSpec extends ObjectBehavior
{
    function it_returns_empty_array_for_no_input()
    {
        $this->calculate([], 0)->shouldReturn([]);
    }

    function it_returns_single_element_for_single_input()
    {
        $this->calculate(['A'], 0)->shouldReturn(['A']);
    }

    function it_returns_transposed_elements_for_two_inputs()
    {
        $this->beConstructedWith();

        $this->calculate(['A', 'B'], 0)->shouldReturn(['A', 'B']);
        $this->calculate(['A', 'B'], 1)->shouldReturn(['B', 'A']);
    }

    function it_returns_correctly_ordered_elements_for_three_inputs()
    {
        $this->beConstructedWith();

        $this->calculate(['A', 'B', 'C'], 0)->shouldReturn(['A', 'B', 'C']);
        $this->calculate(['A', 'B', 'C'], 1)->shouldReturn(['A', 'C', 'B']);
        $this->calculate(['A', 'B', 'C'], 2)->shouldReturn(['B', 'C', 'A']);
        $this->calculate(['A', 'B', 'C'], 3)->shouldReturn(['B', 'A', 'C']);
        $this->calculate(['A', 'B', 'C'], 4)->shouldReturn(['C', 'A', 'B']);
        $this->calculate(['A', 'B', 'C'], 5)->shouldReturn(['C', 'B', 'A']);
    }

    function it_returns_correctly_ordered_elements_for_four_inputs()
    {
        $this->beConstructedWith();

        $this->calculate(['A', 'B', 'C', 'D'], 0)->shouldReturn(['A', 'B', 'C', 'D']);
        $this->calculate(['A', 'B', 'C', 'D'], 7)->shouldReturn(['B', 'C', 'A', 'D']);
    }
}
