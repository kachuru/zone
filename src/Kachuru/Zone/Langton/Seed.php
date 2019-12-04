<?php

namespace Kachuru\Zone\Langton;

class Seed
{
    private $seed;

    public function __construct(int $seed)
    {
        $this->seed = $seed;
    }

    public function getMapTileStateTransitionOrder()
    {
        $transitions = $this->getBaseTransitions();

        $rot1 = floor($this->seed / 6); // 6 = 4! / 4
        $rem1 = $this->seed % 6;

        for ($i = 0; $i < $rot1; $i++) {
            $transitions = $this->rotate($transitions);
        }

        $rot2 = floor($rem1 / 2); // 2 = 3! / 3
        $rem2 = $rem1 % 2;

        $prefix = array_slice($transitions, 0, 1);
        $subTransitions = array_slice($transitions, 1);
        for ($i = 0; $i < $rot2; $i++) {
            $subTransitions = $this->rotate($subTransitions);
        }
        $transitions = array_merge($prefix, $subTransitions);

        $rot3 = floor($rem2 / 1); // 1 = 2! / 2

        $prefix = array_slice($transitions, 0, 2);
        $subTransitions = array_slice($transitions, 2);
        for ($i = 0; $i < $rot3; $i++) {
            $subTransitions = $this->rotate($subTransitions);
        }
        $transitions = array_merge($prefix, $subTransitions);

        return $transitions;
    }

    public function getBaseTransitions()
    {
        return [
            MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_ALPHA],
            MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_BETA],
            MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_GAMMA],
            MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_DELTA],
        ];
    }

//    protected function combinations(array $initial): array
//    {
//        $combinations = [];
//
//        for ($i = 0; $i < count($initial); $i++) {
//            $combinations = (count($initial) > 2)
//                ? array_merge($combinations, $this->calculateCombinations($initial))
//                : array_merge($combinations, [$initial]);
//
//            $initial = $this->rotate($initial);
//        }
//
//        return $combinations;
//    }
//
//    protected function calculateCombinations(array $initial)
//    {
//        $combinations = [];
//
//        $prefixTransition = array_slice($initial, 0, 1);
//        foreach ($this->combinations(array_slice($initial, 1, count($initial))) as $subTransition) {
//            $combinations[] = array_merge($prefixTransition, $subTransition);
//        }
//
//        return $combinations;
//    }

    protected function rotate(array $elements)
    {
        array_push($elements, array_shift($elements));

        return $elements;
    }
}
