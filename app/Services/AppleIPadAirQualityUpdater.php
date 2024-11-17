<?php

namespace App\Services;

use App\Models\Item;

class AppleIPadAirQualityUpdater implements QualityUpdaterInterface
{
    public function update(Item $item): void
    {
        if ($item->sellIn <= 0) {
            $item->quality = 0;
        } else if ($item->sellIn <= 5) {
            $item->quality = min($item->quality + 3, 50);
        } else if ($item->sellIn <= 10) {
            $item->quality = min($item->quality + 2, 50);
        } else {
            $item->quality = min($item->quality + 1, 50);
        }
        $item->sellIn--;
    }
}
