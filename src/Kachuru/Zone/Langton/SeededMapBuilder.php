<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapTile;
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

    public function move(Map $map, MapTileWithState $mapTileWithState, AntState $antState): LangtonMove
    {
        return $this->moveCalculator->getMove($map, $mapTileWithState, $antState);
    }

    public function build(Map $map, $steps): Map
    {
        $antState = new AntState(Map::DIRECTION_NORTH);
        $mapTileWithState = $this->getMapTileWithState($map->getCentreTile());

        for ($step = 0; $step <= $steps; $step++) {
            $langtonMove = $this->move($map, $mapTileWithState, $antState);

            $map->updateTile($langtonMove->getOldLocationUpdatedState());

            $mapTileWithState = $map->getMapTileByTileId($langtonMove->getNewLocation()->getTileId());

            $antState = $langtonMove->getAntNewState();
        }

        return $map;
    }

    private function getMapTileWithState(MapTile $mapTile): MapTileWithState
    {
        if (!$mapTile instanceof MapTileWithState) {
            $mapTile = new MapTileWithState($mapTile, $this->seed->getFirstState());
        }

        return $mapTile;
    }
}
