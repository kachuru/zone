<?php

namespace Kachuru\Zone\Meeple;

class AttackPlus1Modifier implements MeepleModifier
{
    /**
     * @var Meeple
     */
    private $meeple;

    public function __construct(Meeple $meeple)
    {
        $this->meeple = $meeple;
    }

    public function getAttack(): int
    {
        return $this->meeple->getAttack() + 1;
    }

    public function getDefence(): int
    {
        return $this->meeple->getDefence();
    }

    public function getMental(): int
    {
        return $this->meeple->getMental();
    }

    public function getPersona(): int
    {
        return $this->meeple->getPersona();
    }

    public function getPhysical(): int
    {
        return $this->meeple->getPhysical();
    }
}
