<?php

namespace Kachuru\Zone\Map;

class MapDisplay
{
    private $tileHtml;

    public function __construct($tileHtml)
    {
        $this->tileHtml = $tileHtml;
    }

    public function render($size)
    {
        $left = 0;
        $top = 0;
        $col = 0;

        $width = 17;
        $height = 16;

        for ($tile = 1; $tile <= $size; $tile++) {
            $col++;
            $terrain = 'water';

            if ($tile >= $width && $tile < ($width * $height) - $width && $tile % $width != 0 && $tile % $width != 1) {
                $terrain = 'barren';
            }

            printf($this->tileHtml, $tile, $terrain, $left, $top + (($col % 2 == 0) ? 38 : 0), $tile, $tile, $tile);

            $left += 67;

            if ($tile % $width == 0) {
                $col = 0;
                $left = 0;
                $top += 76;
            }
        }
    }
}
