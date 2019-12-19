<?php

namespace Kachuru\Zone\Langton;

class CombinationsCalculator
{
    public function calculate(array $source, int $combinationSeed)
    {
        return count($source) > 1
            ? $this->slice(
                $this->rotate($source, floor($combinationSeed / $this->getFactor(count($source)))),
                $combinationSeed
            )
            : $source;
    }

    private function slice(array $source, int $combinationSeed): array
    {
        return array_merge(
            array_slice($source, 0, 1),
            $this->calculate(
                array_slice($source, 1),
                $combinationSeed % $this->getFactor(count($source))
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

    private function getFactor(int $n): int
    {
        return (int) gmp_fact($n) / $n;
    }
}
