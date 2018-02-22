<?php

namespace Kachuru\Zone\Map;

interface MapTerrain
{
    const TYPE_WATER = 0; // Sea or lake
    const TYPE_PLAINS = 1; // Grasslands
    const TYPE_HILLS = 2; // Low foothills
    const TYPE_MOUNTAINS = 3; // High mountains
    const TYPE_SWAMP = 4; // Marshy swampy
    const TYPE_DESERT = 5; // Desert
    const TYPE_FOREST = 6; // TREES
    const TYPE_TUNDRA = 7; // Cold and icy
}
