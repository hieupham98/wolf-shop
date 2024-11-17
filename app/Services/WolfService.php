<?php
namespace App\Services;

use App\Models\Item;

class WolfService
{
    private $updaters;
    private $specificItemNames = [
        'Apple AirPods',
        'Samsung Galaxy S23',
        'Apple iPad Air',
        'Xiaomi Redmi Note 13'
    ];

    public function __construct(
        RegularItemQualityUpdater $regularItemQualityUpdater,
        AppleAirPodsQualityUpdater $appleAirPodsQualityUpdater,
        SamsungGalaxyS23QualityUpdater $samsungGalaxyS23QualityUpdater,
        AppleIPadAirQualityUpdater $appleIPadAirQualityUpdater,
        XiaomiRedmiNote13QualityUpdater $xiaomiRedmiNote13QualityUpdater
    ) {
        $this->updaters = [
            'Apple AirPods' => $appleAirPodsQualityUpdater,
            'Samsung Galaxy S23' => $samsungGalaxyS23QualityUpdater,
            'Apple iPad Air' => $appleIPadAirQualityUpdater,
            'Xiaomi Redmi Note 13' => $xiaomiRedmiNote13QualityUpdater,
        ];

        $this->regularUpdater = $regularItemQualityUpdater;
    }

    public function updateAllItems()
    {
        foreach (Item::all() as $item) {
            if (in_array($item->name, $this->specificItemNames)) {
                $this->updaters[$item->name]->update($item);
            } else {
                $this->regularUpdater->update($item);
            }

            $item->save();
        }
    }
}
