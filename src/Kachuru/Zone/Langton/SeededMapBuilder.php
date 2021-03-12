<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapTileWithState;

class SeededMapBuilder implements MapBuilder
{
    private $seed;

    private $moveCalculator;

    public function __construct(Seed $seed, MoveCalculator $moveCalculator)
    {
        $this->seed = $seed;
        $this->moveCalculator = $moveCalculator;
    }

    public function move(Map $map, MapTileWithState $mapTileState, AntState $antState): LangtonMove
    {
        return $this->moveCalculator->getMove($map, $mapTileState, $antState);
    }

    public function build(Map $map, $steps): Map
    {
        $currentTile = $map->getCentreTile();

        $antState = new AntState(Map::DIRECTION_NORTH);
        $mapTileState = new MapTileWithState($currentTile, $this->seed->getFirstState());

        for ($step = 0; $step < $steps; $step++) {
            $langtonMove = $this->move($map, $mapTileState, $antState);
            $newLocationTile = $langtonMove->getNewLocation();
            $oldLocationNewState = $langtonMove->getOldLocationUpdatedState();

            // Create a stateful map tile and set it into the map
        }

        return $map;
    }
}
