<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\MapCoordinates;
use Kachuru\Zone\Map\MapTile;

class MapTileState
{
    public const TILE_STATE_ALPHA = 0;
    public const TILE_STATE_BETA = 1;
    public const TILE_STATE_GAMMA = 2;
    public const TILE_STATE_DELTA = 3;

    public const TILE_STATES = [
        self::TILE_STATE_ALPHA,
        self::TILE_STATE_BETA,
        self::TILE_STATE_GAMMA,
        self::TILE_STATE_DELTA
    ];

    public const TILE_STATE_HANDLES = [
        self::TILE_STATE_ALPHA => 'alpha',
        self::TILE_STATE_BETA => 'beta',
        self::TILE_STATE_GAMMA => 'gamma',
        self::TILE_STATE_DELTA => 'delta'
    ];

    private $mapTile;

    private $state;

    public function __construct(MapTile $mapTile, int $state)
    {
        $this->mapTile = $mapTile;

        if (!in_array($state, self::TILE_STATES)) {
            throw new \InvalidArgumentException('Invalid tile state provided');
        }

        $this->state = $state;
    }

    public function getMapTile(): MapTile
    {
        return $this->mapTile;
    }

    public function getMapTileId(): int
    {
        return $this->mapTile->getTileId();
    }

    public function getMapTileCoordinates(): MapCoordinates
    {
        return $this->mapTile->getCoordinates();
    }

    public function getState(): int
    {
        return $this->state;
    }

    public function getStateHandle(): string
    {
        return self::TILE_STATE_HANDLES[$this->state];
    }
}
