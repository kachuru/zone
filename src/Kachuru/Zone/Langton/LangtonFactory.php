<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Util\Combinations;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnFactory;
use Kachuru\Zone\Langton\Transition\TransitionHandler;
use Kachuru\Zone\Map\MapFactory;

class LangtonFactory
{
    private $mapFactory;

    private $combinations;

    private $antTurnFactory;

    public function __construct(
        MapFactory $mapFactory,
        Combinations $combinations,
        AntTurnFactory $antTurnFactory
    ) {
        $this->mapFactory = $mapFactory;
        $this->combinations = $combinations;
        $this->antTurnFactory = $antTurnFactory;
    }

    public function getMap()
    {
        return $this->mapFactory->getMap();
    }

    public function getSeed(int $seed): Seed
    {
        return new Seed($seed, $this->combinations, $this->antTurnFactory);
    }

    public function getSeededMapBuilder(Seed $seed): SeededMapBuilder
    {
        return new SeededMapBuilder($seed, $this->mapFactory, $this->getMoveCalculator($seed));
    }

    public function getMoveCalculator(Seed $seed): MoveCalculator
    {
        return new MoveCalculator($this->mapFactory->getMap(), $this->getTransitionHandler($seed));
    }

    public function getTransitionHandler(Seed $seed): TransitionHandler
    {
        return new TransitionHandler($seed);
    }
}
