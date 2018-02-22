<?php

namespace Kachuru\Zone;

class MapCell
{
    private $x;
    private $y;
    private $type;

    public function __construct($x, $y, $type)
    {
        $this->x = $x;
        $this->y = $y;
        $this->type = $type;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getType()
    {
        return $this->type;
    }
}
