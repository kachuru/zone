<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapBuilder;

class SeededMapBuilder implements MapBuilder
{
    private $seed;
    /**
     * @var MoveCalculator
     */
    private $moveCalculator;

    public function __construct(Seed $seed, MoveCalculator $moveCalculator)
    {
        $this->seed = $seed;
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

    public function build(): Map
    {
        // TODO: Implement build() method.
    }
}
