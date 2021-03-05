<?php

namespace Kachuru\Zone\Map;

class MapTileStates
{
    public function hasTile(int $tileId): bool
    {
        return false;
    }

    public function getTile(int $tileId): ?MapTile
    {
        return null;
    }
}
