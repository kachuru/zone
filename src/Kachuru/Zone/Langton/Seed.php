<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Util\Combinations;

class Seed
{
    private $seed;

    private $combinations;

    public function __construct(
        string $seed,
        Combinations $combinations
    ) {
        $this->seed = $seed;
        $this->combinations = $combinations;
    }

    public function getMapTileStateTransitionOrder(): array
    {
        return $this->combinations->calculate($this->getBaseTransitions(), (int) $this->seed);
    }

    public function getTransitionsRandomSeed()
    {
        return mt_rand(0, gmp_fact(count($this->getBaseTransitions()) - 1));
    }

    public function getBaseTransitions(): array
    {
        return [
            MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_ALPHA],
            MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_BETA],
            MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_GAMMA],
            MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_DELTA],
        ];
    }
}
