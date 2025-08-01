<?php

namespace Kachuru\Zone\Langton;

use Kachuru\MapMaker\Map;

/**
 * Representing the current state of the ant
 * I think what we need is just the current tile state and orientation of the ant
 *
 * @package Kachuru\Zone\Langton
 */
readonly class AntState
{
    public function __construct(
        private int $orientation
    ) {
        if (!in_array($orientation, Map::DIRECTIONS)) {
            throw new \InvalidArgumentException('Orientation for ant must be a map direction');
        }
    }

    public function getOrientation(): int
    {
        return $this->orientation;
    }

    public function getOrientationHandle(): string
    {
        return Map::DIRECTION_HANDLES[$this->orientation];
    }

    public function getClockwiseOrientation(): int
    {
        return ($this->orientation % 6) + 1;
    }

    public function getAnticlockwiseOrientation(): int
    {
        return ($this->orientation - 1) ? : 6;
    }
}
