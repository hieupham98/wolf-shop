<?php

namespace App\Services;

use App\Models\Item;

class AppleAirPodsQualityUpdater implements QualityUpdaterInterface
{
    public function update(Item $item): void
    {
        $item->quality = min($item->quality + 1, 50);
        $item->sellIn--;
    }
}
