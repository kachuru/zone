<?php

namespace Kachuru\Util;

class Math
{
    public static function factorial(int $number): int
    {
        return $number > 1
            ? $number * self::factorial($number - 1)
            : 1;
    }

    public function getFactorial(int $number): int
    {
        return self::factorial($number);
    }
}
