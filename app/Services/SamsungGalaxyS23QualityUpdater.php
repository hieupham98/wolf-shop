<?php

namespace App\Services;

use App\Models\Item;

class SamsungGalaxyS23QualityUpdater implements QualityUpdaterInterface
{
    public function update(Item $item): void
    {
        $item->quality = 80;
    }
}
