<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\Map;
use Kachuru\Zone\Map\MapTile;

class MoveCalculator
{
    private $map;

    public function __construct(Map $map)
    {
        $this->map = $map;
    }

    public function getMap(): Map
    {
        return $this->map;
    }

    public function getMapTileByTileId(int $tileId): MapTile
    {
        return $this->map->getMapTileByTileId($tileId);
    }

    public function getMove(MapTileState $mapTileState, AntState $antState): LangtonMove
    {
        return new LangtonMove(
            $this->getNewAntState($mapTileState, $antState),
            $this->getNewAntPosition($mapTileState, $antState),
            $this->getUpdatedCurrentTileState($mapTileState)
        );
    }

    private function getNewAntState(MapTileState $mapTileState, AntState $antState): AntState
    {
        switch ($mapTileState->getState()) {
            case MapTileState::TILE_STATE_ALPHA:
                return new AntState($antState->getClockwiseOrientation());

            case MapTileState::TILE_STATE_BETA:
                return new AntState($antState->getAnticlockwiseOrientation());

            case MapTileState::TILE_STATE_GAMMA:
                return new AntState(
                    (new AntState($antState->getClockwiseOrientation()))->getClockwiseOrientation()
                );

            case MapTileState::TILE_STATE_DELTA:
                return new AntState(
                    (new AntState($antState->getAnticlockwiseOrientation()))->getAnticlockwiseOrientation()
                );
        }

        throw new \RuntimeException('The map state could not be mapped to an ant move');
    }

    private function getNewAntPosition(MapTileState $mapState, AntState $antState): MapTile
    {
        return $this->map->getMapTileInDirection(
            $mapState->getMapTileCoordinates(),
            $this->getNewAntState($mapState, $antState)->getOrientation()
        );
    }

    private function getUpdatedCurrentTileState(MapTileState $mapTileState): MapTileState
    {
        return new MapTileState($mapTileState->getMapTile(), $this->getNextState($mapTileState->getState()));
    }

    private function getNextState(int $state): int
    {
        return ($state + 1) % 4;
    }
}
