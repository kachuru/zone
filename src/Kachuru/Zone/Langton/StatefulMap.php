<?php

namespace Kachuru\Zone\Langton;

use Kachuru\MapMaker\MapCoordinates;
use Kachuru\MapMaker\MapGrid;
use Kachuru\MapMaker\MapTile;

readonly class StatefulMap implements MapWithState
{
    public function __construct(
        private MapGrid $mapStencil,
        private MapTileStates $mapTileStates,
        private Seed $seed
    ) {
    }

    /** @return iterable<int, MapTile> */
    public function getMapTiles(): iterable
    {
        for ($tileId = 0; $tileId < $this->mapStencil->getMapSize(); $tileId++) {
            if ($this->mapTileStates->hasTile($tileId)) {
                yield $this->getMapTileByTileId($tileId);
            } else {
                yield $this->mapStencil->getMapTileByTileId($tileId);
            }
        }
    }

    public function getMapTileByTileId(int $tileId): MapTile
    {
        if (!$this->mapTileStates->hasTile($tileId)) {
            $this->mapTileStates->setTile(
                new MapTileWithState($this->mapStencil->getMapTileByTileId($tileId), $this->seed->getFirstState())
            );
        }

        return $this->mapTileStates->getTile($tileId);
    }

    public function getMapTileByCoordinates(MapCoordinates $mapCoordinates): MapTile
    {
        $mapTile = $this->mapStencil->getMapTileByCoordinates($mapCoordinates);
        return $this->getMapTileByTileId($mapTile->getTileId());
    }

    public function getCentreTile(): MapTile
    {
        return $this->mapStencil->getCentreTile();
    }

    /** @return iterable<int, int> */
    public function getAdjacentTiles(MapCoordinates $mapCoordinates): iterable
    {
        return $this->mapStencil->getAdjacentTiles($mapCoordinates);
    }

    public function getMapTileInDirection(MapCoordinates $mapCoordinates, int $direction): MapTile
    {
        return $this->mapStencil->getMapTileInDirection($mapCoordinates, $direction);
    }

    public function updateTile(MapTileWithState $mapTileWithState): void
    {
        $this->mapTileStates->setTile($mapTileWithState);
    }
}
