<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\MapTile;
use Kachuru\Zone\Map\MapTileWithState;

class LangtonMove
{
    private $antNewState;

    private $newLocation;

    private $oldLocationUpdatedState;

    public function __construct(
        AntState $antNewState,
        MapTile $newLocation,
        MapTileWithState $oldLocationUpdatedState
    ) {
        $this->antNewState = $antNewState;
        $this->newLocation = $newLocation;
        $this->oldLocationUpdatedState = $oldLocationUpdatedState;
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
