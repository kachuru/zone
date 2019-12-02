<?php

namespace Kachuru\Zone\Langton;

class Seed
{
    private $seed;

    public function __construct(int $seed)
    {
        $this->seed = $seed;
    }

    public function getMapTileStateTransitions()
    {
        return $this->getBaseTransitions();
    }

    public function getAllTransitions()
    {
        return $this->combinations($this->getBaseTransitions());
    }

    public function getBaseTransitions()
    {
        return [
            MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_ALPHA],
            MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_BETA],
            MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_GAMMA],
            MapTileState::TILE_STATE_HANDLES[MapTileState::TILE_STATE_DELTA],
        ];
    }

    protected function combinations(array $initial): array
    {
        $combinations = [];

        for ($i = 0; $i < count($initial); $i++) {
            if (count($initial) >= 2) {
                $prefixTransition = array_slice($initial, 0, 1);
                foreach ($this->combinations(array_slice($initial, 1, count($initial))) as $subTransition) {
                    $combinations[] = array_merge($prefixTransition, $subTransition);
                }
            } else {
                $combinations[] = $initial;
            }

            $initial = $this->rotate($initial);
        }

        return $combinations;
    }

    protected function rotate(array $elements)
    {
        array_push($elements, array_shift($elements));

        return $elements;
    }
}
