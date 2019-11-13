<?php

namespace Kachuru\Zone\Langton\Transition;

use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\MapTileState;

class TransitionHandler
{
    private $stateTransitions = [];

    public function __construct()
    {
        /**
         * Strictly speaking, I think this should be handled in the services.yaml file BUT once we use seeds instead
         * the transitions will probably need to be created dynamically, so we will probably want a factory instead
         */

        $this->addStateTransition($this->getStateHandle(MapTileState::TILE_STATE_ALPHA), new AlphaStateTransition());
        $this->addStateTransition($this->getStateHandle(MapTileState::TILE_STATE_BETA), new BetaStateTransition());
        $this->addStateTransition($this->getStateHandle(MapTileState::TILE_STATE_GAMMA), new GammaStateTransition());
        $this->addStateTransition($this->getStateHandle(MapTileState::TILE_STATE_DELTA), new DeltaStateTransition());
    }

    public function addStateTransition(string $handle, StateTransition $stateTransition)
    {
        if ($this->transitionHandleIsSet($handle)) {
            throw new \RuntimeException(sprintf('State transition for state "%s" already exists', $handle));
        }

        $this->stateTransitions[$handle] = $stateTransition;
    }

    public function getAntStateTransitionForMapTileState(string $handle, AntState $currentAntState): AntState
    {
        if (!$this->transitionHandleIsSet($handle)) {
            throw new \RuntimeException(sprintf('State transition for state "%s" does not exist', $handle));
        }

        return $this->stateTransitions[$handle]->getNextAntState($currentAntState);
    }

    public function getMapTileNextState(MapTileState $mapTileState): MapTileState
    {
        return $this->stateTransitions[$mapTileState->getStateHandle()]->getNextTileState($mapTileState);
    }

    protected function transitionHandleIsSet(string $handle): bool
    {
        return array_key_exists($handle, $this->stateTransitions);
    }

    protected function getStateHandle(int $tileStateId)
    {
        return MapTileState::TILE_STATE_HANDLES[$tileStateId];
    }
}
