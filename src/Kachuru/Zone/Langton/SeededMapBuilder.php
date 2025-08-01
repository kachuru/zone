<?php

namespace Kachuru\Zone\Langton;

use Kachuru\MapMaker\Map;
use Kachuru\MapMaker\MapTile;

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

    public function build(MapWithState $map, int $steps): Map
    {
        $antState = new AntState(Map::DIRECTION_NORTH);
        $mapTileWithState = $this->getMapTileWithState($map->getCentreTile());

        for ($step = 1; $step <= $steps; $step++) {
            $langtonMove = $this->move($map, $mapTileWithState, $antState);

            $map->updateTile($langtonMove->getOldLocationUpdatedState());

            $antState = $langtonMove->getAntNewState();
            $mapTileWithState = $this->getMapTileWithState(
                $map->getMapTileByTileId($langtonMove->getNewLocation()->getTileId())
            );
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
