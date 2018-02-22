<?php

namespace Kachuru\Zone\Map;

class MapCoordinates
{
    private $radial;
    private $degree;

    public function __construct(int $radial, int $degree)
    {
        $this->radial = $radial;
        $this->degree = $degree;
    }

    public function __toString(): string
    {
        return sprintf('%d:%d', $this->radial, $this->degree);
    }

    public function getRadial(): int
    {
        return $this->radial;
    }

    public function getDegree(): int
    {
        return $this->degree;
    }
}
