<?php

namespace Kachuru\Zone\Langton;

class TransitionsCalculator
{
    public function calculate($transitions, $seed)
    {
        return count($transitions) > 1
            ? $this->slice(
                $this->rotate($transitions, floor($seed / $this->getFactor(count($transitions)))),
                $seed
            )
            : $transitions;
    }

    private function slice(array $transitions, $seed): array
    {
        return array_merge(
            array_slice($transitions, 0, 1),
            $this->calculate(
                array_slice($transitions, 1),
                $seed % $this->getFactor(count($transitions))
            )
        );
    }

    private function rotate(array $elements, $times = 1): array
    {
        for ($i = 0; $i < $times; $i++) {
            array_push($elements, array_shift($elements));
        }

        return $elements;
    }

    private function getFactor(int $n)
    {
        return gmp_fact($n) / $n;
    }

}
