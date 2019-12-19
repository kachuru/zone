<?php

namespace Kachuru\Zone\Langton;

class Seed
{
    private $seed;

    private $combinationsCalculator;

    public function __construct(string $seed, CombinationsCalculator $combinationsCalculator)
    {
        $this->seed = $seed;
        $this->combinationsCalculator = $combinationsCalculator;
    }

    public function getMapTileStateTransitionOrder(): array
    {
        return $this->combinationsCalculator->calculate($this->getBaseTransitions(), (int) $this->seed);
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
