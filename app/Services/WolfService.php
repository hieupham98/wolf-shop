<?php

namespace App\Services;

use App\Models\Item;

class WolfService
{
    private $updaters;

    public function __construct(
        RegularItemQualityUpdater $regularItemQualityUpdater,
        AppleAirPodsQualityUpdater $appleAirPodsQualityUpdater,
        SamsungGalaxyS23QualityUpdater $samsungGalaxyS23QualityUpdater,
        AppleIPadAirQualityUpdater $appleIPadAirQualityUpdater,
        XiaomiRedmiNote13QualityUpdater $xiaomiRedmiNote13QualityUpdater
    ) {
        $this->updaters = [
            'Regular' => $regularItemQualityUpdater,
            'Apple AirPods' => $appleAirPodsQualityUpdater,
            'Samsung Galaxy S23' => $samsungGalaxyS23QualityUpdater,
            'Apple iPad Air' => $appleIPadAirQualityUpdater,
            'Xiaomi Redmi Note 13' => $xiaomiRedmiNote13QualityUpdater,
        ];

        //TODO: add table category for saving those type 
    }

    public function updateAllItems()
    {
        foreach (Item::all() as $item) {
            if (isset($this->updaters[$item->name])) {
                $this->updaters[$item->name]->update($item);
                $item->save();
            }
        }
    }
}
