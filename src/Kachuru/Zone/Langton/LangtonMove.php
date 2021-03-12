<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\BaseMapTile;
use Kachuru\Zone\Map\MapTileWithState;

/**
 * Representing the ant's next move.
 * Where
 *
 * @package Kachuru\Zone\Langton
 */
class LangtonMove
{
    /**
     * @var AntState
     */
    private $antNewState;
    /**
     * @var BaseMapTile
     */
    private $newLocation;
    /**
     * @var MapTileWithState
     */
    private $oldLocationUpdatedState;

    public function __construct(
        AntState $antNewState,
        BaseMapTile $newLocation,
        MapTileWithState $oldLocationUpdatedState
    ) {
        $this->antNewState = $antNewState;
        $this->newLocation = $newLocation;
        $this->oldLocationUpdatedState = $oldLocationUpdatedState;
    }

    /**
     * @return AntState
     */
    public function getAntNewState(): AntState
    {
        return $this->antNewState;
    }

    /**
     * @return BaseMapTile
     */
    public function getNewLocation(): BaseMapTile
    {
        return $this->newLocation;
    }

    /**
     * @return MapTileWithState
     */
    public function getOldLocationUpdatedState(): MapTileWithState
    {
        return $this->oldLocationUpdatedState;
    }
}
