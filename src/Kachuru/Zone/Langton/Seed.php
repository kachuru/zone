<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnFactory;
use Kachuru\Util\Combinations;
use Kachuru\Zone\Map\MapTileState;

class Seed
{
    /**
     * The Seed, of the format ABBBBBCC
     *   A: The transition set to use (1: 4 transitions, 2: 8 transitions)
     *   B: The transition configuration (00000-00023 or 00000-40319)
     *   C: The step-turn configuration to use (0-23)
     * e.g. 10001709, 23251413
     *
     * @var int $seedId The ID representing the seed
     */
    private $seedId;

    private $combinations;

    private $antTurnFactory;

    public function __construct(int $seed, Combinations $combinations, AntTurnFactory $antTurnFactory)
    {
        $this->seedId = $seed;
        $this->combinations = $combinations;
        $this->antTurnFactory = $antTurnFactory;
    }

    public function getSeedId()
    {
        return $this->seedId;
    }

    public static function getTransitionsRandomSeed()
    {
        $set = mt_rand(1, 2);

        return (int) sprintf('%d%05d%02d', $set, mt_rand(0, $set == 1 ? 23 : 40319), mt_rand(0, 23));
    }

    public function getMapTileStateTransitionOrder(): array
    {
        return $this->combinations->calculate($this->getBaseTransitions(), $this->getTransitionSeedId());
    }

    public function getFirstState(): string
    {
        return $this->getMapTileStateTransitionOrder()[0];
    }

    public function getBaseTransitions(): array
    {
        return ($this->getTransitionSetId() == 1)
            ? array_slice(MapTileState::TILE_STATES, 0, 4)
            : MapTileState::TILE_STATES;
    }

    public function getAntTurnOrder()
    {
        return $this->combinations->calculate($this->antTurnFactory->getAntTurns(), $this->getAntTurnSeedId());
    }

    private function getTransitionSetId()
    {
        return (int) substr($this->seedId, 0, 1);
    }

    private function getTransitionSeedId()
    {
        return (int) substr($this->seedId, 1, 5);
    }

    private function getAntTurnSeedId()
    {
        return (int) substr($this->seedId, 7, 2);
    }
}
