<?php

namespace Kachuru\Zone\Meeple;

class BasicMeeple implements Meeple
{
    const BASE_PHYSICAL = 1;
    const BASE_MENTAL = 1;
    const BASE_PERSONA = 1;

    public function getPhysical(): int
    {
        return self::BASE_PHYSICAL;
    }

    public function getMental(): int
    {
        return self::BASE_MENTAL;
    }

    public function getPersona(): int
    {
        return self::BASE_PERSONA;
    }
}
