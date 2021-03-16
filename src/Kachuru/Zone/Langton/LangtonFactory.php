<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Util\Combinations;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnFactory;
use Kachuru\Zone\Langton\Transition\TransitionHandler;
use Kachuru\MapMaker\MapGrid;

class LangtonFactory
{
    private $combinations;

    private $antTurnFactory;

    private $mapStencil;

    public function __construct(
        Combinations $combinations,
        AntTurnFactory $antTurnFactory,
        MapGrid $mapStencil
    ) {
        $this->combinations = $combinations;
        $this->antTurnFactory = $antTurnFactory;
        $this->mapStencil = $mapStencil;
    }

    public function getMapStencil(): MapGrid
    {
        return $this->mapStencil;
    }

    public function getSeed(int $seed): Seed
    {
        return new Seed($seed, $this->combinations, $this->antTurnFactory);
    }

    public function getStatefulMap(Seed $seed): StatefulMap
    {
        return new StatefulMap($this->mapStencil, new MapTileStates(), $seed);
    }

    public function getSeededMapBuilder(Seed $seed): SeededMapBuilder
    {
        return new SeededMapBuilder($seed, $this->getMoveCalculator($seed));
    }

    public function getMoveCalculator(Seed $seed): MoveCalculator
    {
        return new MoveCalculator($this->getTransitionHandler($seed));
    }

    public function getTransitionHandler(Seed $seed): TransitionHandler
    {
        return new TransitionHandler($seed);
    }
}
