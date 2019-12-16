<?php

namespace Kachuru\Zone\Langton;

class Seed
{
    private $seed;

    private $transitionsCalculator;

    public function __construct(
        int $seed,
        TransitionsCalculator $transitionsCalculator
    ) {
        $this->seed = $seed;
        $this->transitionsCalculator = $transitionsCalculator;
    }

    public function getMapTileStateTransitionOrder(): array
    {
        return $this->transitionsCalculator->calculate($this->getBaseTransitions(), $this->seed);
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
