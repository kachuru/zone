<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapTileState;

class SeededMapBuilder implements MapBuilder
{
    private $seed;

    private $moveCalculator;

    public function __construct(Seed $seed, MoveCalculator $moveCalculator)
    {
        $this->seed = $seed;
        $this->moveCalculator = $moveCalculator;
    }

    public function move(Map $map, MapTileState $mapTileState, AntState $antState): LangtonMove
    {
        return $this->moveCalculator->getMove($map, $mapTileState, $antState);
    }

    public function build(Map $map, $steps): Map
    {
        $currentTile = $map->getCentreTile();

        for ($step = 0; $step < $steps; $step++) {
            // $langtonMove = $this->move($currentTile, $antState);
        }

        return $map;
    }
}
