<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Util\Combinations;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnFactory;
use Kachuru\Zone\Langton\Transition\TransitionHandler;
use Kachuru\Zone\Map\MapStencil;

class SeedFactory
{
    private $map;

    private $combinations;

    private $antTurnFactory;

    public function __construct(
        MapStencil $map,
        Combinations $combinations,
        AntTurnFactory $antTurnFactory
    ) {
        $this->map = $map;
        $this->combinations = $combinations;
        $this->antTurnFactory = $antTurnFactory;
    }

    public function getSeed(int $seed): Seed
    {
        return new Seed($seed, $this->combinations, $this->antTurnFactory);
    }

    public function getSeededMapBuilder(Seed $seed): SeededMapBuilder
    {
        return new SeededMapBuilder($seed, $this->getMoveCalculator($seed));
    }

    public function getMoveCalculator(Seed $seed): MoveCalculator
    {
        return new MoveCalculator($this->map, $this->getTransitionHandler($seed));
    }

    public function getTransitionHandler(Seed $seed): TransitionHandler
    {
        return new TransitionHandler($seed);
    }
}
