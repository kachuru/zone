<?php

namespace Kachuru\Zone\Langton;

use Kachuru\MapMaker\MapTile;
use Kachuru\MapMaker\MapCoordinates;

class MapTileWithState implements MapTile
{
    public const TILE_STATE_ALPHA = 0;
    public const TILE_STATE_BETA = 1;
    public const TILE_STATE_GAMMA = 2;
    public const TILE_STATE_DELTA = 3;
    public const TILE_STATE_EPSILON = 4;
    public const TILE_STATE_ZETA = 5;
    public const TILE_STATE_ETA = 6;
    public const TILE_STATE_THETA = 7;

    public const TILE_STATES = [
        self::TILE_STATE_ALPHA,
        self::TILE_STATE_BETA,
        self::TILE_STATE_GAMMA,
        self::TILE_STATE_DELTA,
        self::TILE_STATE_EPSILON,
        self::TILE_STATE_ZETA,
        self::TILE_STATE_ETA,
        self::TILE_STATE_THETA,
    ];

    public const TILE_STATE_HANDLES = [
        self::TILE_STATE_ALPHA => 'alpha',
        self::TILE_STATE_BETA => 'beta',
        self::TILE_STATE_GAMMA => 'gamma',
        self::TILE_STATE_DELTA => 'delta',
        self::TILE_STATE_EPSILON => 'epsilon',
        self::TILE_STATE_ZETA => 'zeta',
        self::TILE_STATE_ETA => 'eta',
        self::TILE_STATE_THETA => 'theta',
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

    public function getTileId(): int
    {
        return $this->mapTile->getTileId();
    }

    public function getCoordinates(): MapCoordinates
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
