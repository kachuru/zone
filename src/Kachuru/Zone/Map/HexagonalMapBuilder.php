<?php

namespace Kachuru\Zone\Map;

class HexagonalMapBuilder implements MapBuilder
{
    private $mapTileFactory;

    public function __construct(MapTileFactory $mapTileFactory)
    {
        $this->mapTileFactory = $mapTileFactory;
    }

    public function build(int $size): HexagonalMap
    {
        return new HexagonalMap(
            array_map(
                function ($tileNumber) {
                    return $this->mapTileFactory->createTile(
                        $tileNumber,
                        $this->getMapCoordinatesByTileNumber($tileNumber)
                    );
                },
                range(1, $this->getNumberOfTilesFromSize($size))
            )
        );
    }
    
    public function getNumberOfTilesFromSize(int $size): int
    {
        // A size of 1 means one tile.
        // A size of 2 includes the original core tile, plus the six surrounding tiles.
        // For each additional layer you increase the number of tiles by the number in the previous layer, plus six, so
        //   the third layer adds 12, the fourth 18, and so on.
        // So the number of tiles in each layer is ($size - 1) * 6. We find the total number of tiles by recursively
        //   adding the number of tiles in each previous layer until we reach the core tile, which just adds 1.

        return $size > 1
            ? (($size - 1) * 6) + $this->getNumberOfTilesFromSize($size - 1)
            : 1;
    }

    public function getMapCoordinatesByTileNumber(int $tileNumber): MapCoordinates
    {
        $lastTiles = $tiles = 1;
        $radial = 1;

        while ($tileNumber > $tiles) {
            $lastTiles = $tiles;
            $tiles += $radial * 6;
            $radial++;
        }

        $degree = ($tileNumber > 1)
            ? $tileNumber - $lastTiles
            : 1;

        return $this->mapTileFactory->createMapCoordinates($radial, $degree);
    }
}
