<?php

namespace Kachuru\Zone\Map;

use Kachuru\Zone\Langton\Seed;

class StatefulMap implements Map
{
    private $mapStencil;

    private $mapTileStates;

    private $seed;

    public function __construct(MapStencil $mapStencil, MapTileStates $mapTileStates, Seed $seed)
    {
        $this->mapStencil = $mapStencil;
        $this->mapTileStates = $mapTileStates;
        $this->seed = $seed;
    }

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

    public function getMapTileByTileId(string $tileId): MapTile
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
