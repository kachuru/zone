<?php

namespace Kachuru\Zone\Langton\Transition;

use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\MapTileState;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurn;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnAnticlockwiseOnce;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnAnticlockwiseTwice;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnClockwiseOnce;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurnClockwiseTwice;

class TransitionHandler
{
    private $stateTransitions = [];

    public function __construct()
    {
        /* This needs to come from the Seed */
        $states = [
            MapTileState::TILE_STATE_ALPHA => [
                'turn' => new AntTurnClockwiseOnce(),
                'nextState' => MapTileState::TILE_STATE_BETA
            ],
            MapTileState::TILE_STATE_BETA => [
                'turn' => new AntTurnAnticlockwiseOnce(),
                'nextState' => MapTileState::TILE_STATE_GAMMA
            ],
            MapTileState::TILE_STATE_GAMMA => [
                'turn' => new AntTurnClockwiseTwice(),
                'nextState' => MapTileState::TILE_STATE_DELTA
            ],
            MapTileState::TILE_STATE_DELTA => [
                'turn' => new AntTurnAnticlockwiseTwice(),
                'nextState' => MapTileState::TILE_STATE_ALPHA
            ],
        ];

        foreach ($states as $stateId => $state) {
            $this->addStateTransition(
                $this->getStateHandle($stateId),
                $this->buildStateTransition($state['turn'], $state['nextState'])
            );
        }
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

    private function buildStateTransition(AntTurn $antTurn, int $nextStateId): StateTransition
    {
        return new StateTransition($antTurn, $nextStateId);
    }
}
