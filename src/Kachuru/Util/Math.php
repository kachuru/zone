<?php

namespace Kachuru\Util;

class Math
{
    public static function factorial(int $number): int
    {
        $factorial = 1;

        while ($number >= 1) {
            $factorial = $factorial * $number;

            $number--;
        }

        return $factorial;
    }

    public function getFactorial(int $number): int
    {
        return self::factorial($number);
    }
}
