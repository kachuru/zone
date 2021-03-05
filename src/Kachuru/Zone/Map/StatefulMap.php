<?php

namespace Kachuru\Zone\Map;

class StatefulMap implements Map
{
    private $mapStencil;

    private $mapTileStates;

    public function __construct(MapStencil $mapStencil, MapTileStates $mapTileStates)
    {
        $this->mapStencil = $mapStencil;
        $this->mapTileStates = $mapTileStates;
    }

    public function getMapTiles(): iterable
    {
        return [];
    }

    public function getMapTileByTileId(string $tileId): MapTile
    {
        if (!$this->mapTileStates->hasTile($tileId)) {
            // Create a stateful map tile and set it into the collection
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
}
