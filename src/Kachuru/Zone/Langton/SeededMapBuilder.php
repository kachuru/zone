<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapBuilder;
use Kachuru\Zone\Map\MapFactory;

class SeededMapBuilder implements MapBuilder
{
    private $seed;

    private $moveCalculator;

    private $mapFactory;

    public function __construct(Seed $seed, MapFactory $mapFactory, MoveCalculator $moveCalculator)
    {
        $this->seed = $seed;
        $this->mapFactory = $mapFactory;
        $this->moveCalculator = $moveCalculator;
    }

    public function initialise(): Map
    {
        return $this->moveCalculator->getMap();
    }

    public function move(MapTileState $mapTileState, AntState $antState): LangtonMove
    {
        return $this->moveCalculator->getMove($mapTileState, $antState);
    }

    public function build($steps): Map
    {
        $map = $this->initialise();
        $currentTile = $map->getCentreTile();

        for ($step = 0; $step < $steps; $step++) {
            // $langtonMove = $this->move($currentTile, $antState);
        }

        return $map;
    }
}
