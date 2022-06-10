<?php

namespace Kachuru\Zone\Langton\Transition;

use Kachuru\Zone\Langton\AntState;
use Kachuru\Zone\Langton\MapTileWithState;
use Kachuru\Zone\Langton\Seed;
use Kachuru\Zone\Langton\Transition\AntTurn\AntTurn;

class TransitionHandler
{
    private $stateTransitions = [];

    public function __construct(Seed $seed)
    {
        $turn = $seed->getAntTurnOrder();

        $transitionOrder = $seed->getMapTileStateTransitionOrder();

        foreach ($transitionOrder as $idx => $stateId) {
            $this->addStateTransition(
                $this->getStateHandle($stateId),
                $this->buildStateTransition(
                    $turn[($idx % count($turn))],
                    $transitionOrder[$this->getNextTransitionOffset($idx, count($transitionOrder))]
                )
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

    public function getMapTileNextState(MapTileWithState $mapTileState): MapTileWithState
    {
        return $this->stateTransitions[$mapTileState->getStateHandle()]->getNextTileState($mapTileState);
    }

    protected function transitionHandleIsSet(string $handle): bool
    {
        return array_key_exists($handle, $this->stateTransitions);
    }

    protected function getStateHandle(int $tileStateId)
    {
        return MapTileWithState::TILE_STATE_HANDLES[$tileStateId];
    }

    private function buildStateTransition(AntTurn $antTurn, int $nextStateId): StateTransition
    {
        return new StateTransition($antTurn, $nextStateId);
    }

    private function getNextTransitionOffset($idx, $transitions): int
    {
        return ($idx + 1) < $transitions
            ? ($idx + 1)
            : 0;
    }
}
