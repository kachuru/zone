<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Util\Combinations;
use Kachuru\Util\Math;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnAnticlockwiseOnce;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnAnticlockwiseTwice;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnClockwiseOnce;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnClockwiseTwice;

class Seed
{
    const BASE_TRANSITIONS = [
        MapTileState::TILE_STATE_ALPHA,
        MapTileState::TILE_STATE_BETA,
        MapTileState::TILE_STATE_GAMMA,
        MapTileState::TILE_STATE_DELTA,
    ];

    private $seedId;

    private $combinations;

    public function __construct(int $seed, Combinations $combinations)
    {
        $this->seedId = $seed;
        $this->combinations = $combinations;
    }

    public function getSeedId()
    {
        return $this->seedId;
    }

    public static function getTransitionsRandomSeed()
    {
        return mt_rand(0, Math::factorial(count(self::BASE_TRANSITIONS) - 1));
    }

    public function getMapTileStateTransitionOrder(): array
    {
        return $this->combinations->calculate($this->getBaseTransitions(), (int) $this->seedId);
    }

    public function getBaseTransitions(): array
    {
//        if ($this->seedId < Math::factorial(4)) {
//            return array_slice(self::BASE_TRANSITIONS, 0, 4);
//        }

        return self::BASE_TRANSITIONS;
    }

    public function getAntTurnOrder()
    {
        return [
            new AntTurnClockwiseOnce(),
            new AntTurnAnticlockwiseOnce(),
            new AntTurnClockwiseTwice(),
            new AntTurnAnticlockwiseTwice()
        ];
    }
}
