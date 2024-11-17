<?php

namespace App\Services;

use App\Models\Item;

class RegularItemQualityUpdater implements QualityUpdaterInterface
{
    public function update(Item $item): void
    {
        if ($item->sellIn <= 0) {
            $item->quality = max($item->quality - 2, 0);
        } else {
            $item->quality = max($item->quality - 1, 0);
        }
    
        $item->sellIn--;
    }
}
