<?php

namespace Kachuru\Zone\Langton;

use Kachuru\MapMaker\MapTile;

readonly class LangtonMove
{
    public function __construct(
        private AntState $antNewState,
        private MapTile $newLocation,
        private MapTileWithState $oldLocationUpdatedState
    ) {
    }

    public function getAntNewState(): AntState
    {
        return $this->antNewState;
    }

    public function getNewLocation(): MapTile
    {
        return $this->newLocation;
    }

    public function getOldLocationUpdatedState(): MapTileWithState
    {
        return $this->oldLocationUpdatedState;
    }
}
