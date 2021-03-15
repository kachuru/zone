<?php

namespace Kachuru\Zone\Map;

interface Map
{
    public const DIRECTION_NORTH = 1;
    public const DIRECTION_NORTHEAST = 2;
    public const DIRECTION_SOUTHEAST = 3;
    public const DIRECTION_SOUTH = 4;
    public const DIRECTION_SOUTHWEST = 5;
    public const DIRECTION_NORTHWEST = 6;

    public const DIRECTIONS = [
        self::DIRECTION_NORTH,
        self::DIRECTION_NORTHEAST,
        self::DIRECTION_SOUTHEAST,
        self::DIRECTION_SOUTH,
        self::DIRECTION_SOUTHWEST,
        self::DIRECTION_NORTHWEST
    ];

    public const DIRECTION_HANDLES = [
        self::DIRECTION_NORTH => 'n',
        self::DIRECTION_NORTHEAST => 'ne',
        self::DIRECTION_SOUTHEAST => 'se',
        self::DIRECTION_SOUTH => 's',
        self::DIRECTION_SOUTHWEST => 'sw',
        self::DIRECTION_NORTHWEST => 'nw'
    ];

    public function getMapTiles(): iterable;

    public function getMapTileByTileId(string $tileId): MapTile;

    public function getMapTileByCoordinates(MapCoordinates $mapCoordinates): MapTile;

    public function getCentreTile(): MapTile;

    public function getAdjacentTiles(MapCoordinates $mapCoordinates): iterable;

    public function getMapTileInDirection(MapCoordinates $mapCoordinates, int $direction): MapTile;

    public function updateTile(MapTileWithState $mapTileWithState): void;
}
