<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Util\Combinations;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurn;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnFactory;

readonly class Seed
{
    /**
     * The Seed, of the format ABBBBBCC
     *   A: The transition set to use (1: 4 transitions, 2: 8 transitions)
     *   B: The transition configuration (00000-00023 or 00000-40319)
     *   C: The step-turn configuration to use (0-23)
     * e.g. 10001709, 23251413
     */
    public function __construct(
        private string $seed,
        private Combinations $combinations,
        private AntTurnFactory $antTurnFactory
    ) {
    }

    public function getSeed(): string
    {
        return $this->seed;
    }

    public static function getTransitionsRandomSeed(): string
    {
        $set = mt_rand(1, 2);

        return sprintf('%d%05d%02d', $set, mt_rand(0, $set == 1 ? 23 : 40319), mt_rand(0, 23));
    }

    /** @return array<int, int> */
    public function getMapTileStateTransitionOrder(): array
    {
        /** @var array<int, int> $combinations */
        $combinations = $this->combinations->calculate($this->getBaseTransitions(), $this->getTransitionSeedId());
        return $combinations;
    }

    public function getFirstState(): int
    {
        return $this->getMapTileStateTransitionOrder()[0];
    }

    /** @return array<int, int> */
    public function getBaseTransitions(): array
    {
        return $this->getTransitionSetId() === 1
            ? array_slice(MapTileWithState::TILE_STATES, 0, 4)
            : MapTileWithState::TILE_STATES;
    }

    /** @return array<int, AntTurn> */
    public function getAntTurnOrder(): array
    {
        /** @var array<int, AntTurn> $combinations */
        $combinations = $this->combinations->calculate($this->antTurnFactory->getAntTurns(), $this->getAntTurnSeedId());
        return $combinations;
    }

    private function getTransitionSetId(): int
    {
        return (int) substr($this->seed, 0, 1);
    }

    private function getTransitionSeedId(): int
    {
        return (int) substr($this->seed, 1, 5);
    }

    private function getAntTurnSeedId(): int
    {
        return (int) substr($this->seed, 7, 2);
    }
}
