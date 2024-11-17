<?php

use PHPUnit\Framework\TestCase;
use App\Models\Item;
use App\Services\AppleAirPodsQualityUpdater;

class AppleAirPodsQualityUpdaterTest extends TestCase
{
    public function testUpdateQualityWhenSellInGreaterThanZero()
    {
        $item = new Item();
        $item->sellIn = 5;
        $item->quality = 30;

        $updater = new AppleAirPodsQualityUpdater();
        $updater->update($item);

        $this->assertEquals(31, $item->quality);
        $this->assertEquals(4, $item->sellIn);
    }

    public function testUpdateQualityWhenSellInIsZero()
    {
        $item = new Item();
        $item->sellIn = 0;
        $item->quality = 30;

        $updater = new AppleAirPodsQualityUpdater();
        $updater->update($item);

        $this->assertEquals(31, $item->quality);
        $this->assertEquals(-1, $item->sellIn);
    }
}
