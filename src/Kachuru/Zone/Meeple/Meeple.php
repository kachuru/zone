<?php

namespace Kachuru\Zone\Meeple;

interface Meeple
{
    public function getPhysical(): int;
    public function getMental(): int;
    public function getPersona(): int;
}
