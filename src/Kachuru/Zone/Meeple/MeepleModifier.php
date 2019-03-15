<?php
/**
 * Created by PhpStorm.
 * User: rjones
 * Date: 19/09/2018
 * Time: 14:18
 */

namespace Kachuru\Zone\Meeple;

interface MeepleModifier extends Meeple
{
    public function __construct(Meeple $meeple);
}
