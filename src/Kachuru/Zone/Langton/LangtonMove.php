<?php

namespace Kachuru\Zone\Langton;

use Kachuru\Zone\Map\MapTile;

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
     * @var MapTile
     */
    private $newLocation;
    /**
     * @var MapTileState
     */
    private $oldLocationUpdatedState;

    public function __construct(
        AntState $antNewState,
        MapTile $newLocation,
        MapTileState $oldLocationUpdatedState
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
     * @return MapTile
     */
    public function getNewLocation(): MapTile
    {
        return $this->newLocation;
    }

    /**
     * @return MapTileState
     */
    public function getOldLocationUpdatedState(): MapTileState
    {
        return $this->oldLocationUpdatedState;
    }
}
