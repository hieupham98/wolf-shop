<?php

use PHPUnit\Framework\TestCase;
use App\Models\Item;
use App\Services\AppleIPadAirQualityUpdater;

class AppleIPadAirQualityUpdaterTest extends TestCase
{
    public function testUpdateQualityWhenSellInGreaterThan10()
    {
        $item = new Item();
        $item->sellIn = 15;
        $item->quality = 30;

        $updater = new AppleIPadAirQualityUpdater();
        $updater->update($item);

        $this->assertEquals(31, $item->quality);
        $this->assertEquals(14, $item->sellIn);
    }

    public function testUpdateQualityWhenSellInBetween6And10()
    {
        $item = new Item();
        $item->sellIn = 8;
        $item->quality = 30;

        $updater = new AppleIPadAirQualityUpdater();
        $updater->update($item);

        $this->assertEquals(32, $item->quality);
        $this->assertEquals(7, $item->sellIn);
    }

    public function testUpdateQualityWhenSellInBetween1And5()
    {
        $item = new Item();
        $item->sellIn = 3;
        $item->quality = 30;

        $updater = new AppleIPadAirQualityUpdater();
        $updater->update($item);

        $this->assertEquals(33, $item->quality);
        $this->assertEquals(2, $item->sellIn);
    }

    public function testUpdateQualityWhenSellInIsZero()
    {
        $item = new Item();
        $item->sellIn = 0;
        $item->quality = 30;

        $updater = new AppleIPadAirQualityUpdater();
        $updater->update($item);

        $this->assertEquals(0, $item->quality);
        $this->assertEquals(-1, $item->sellIn);
    }
}
