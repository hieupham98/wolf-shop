<?php

use PHPUnit\Framework\TestCase;
use App\Models\Item;
use App\Services\SamsungGalaxyS23QualityUpdater;

class SamsungGalaxyS23QualityUpdaterTest extends TestCase
{
    public function testUpdateQualityAlways80()
    {
        $item = new Item();
        $item->sellIn = 10;
        $item->quality = 50;

        $updater = new SamsungGalaxyS23QualityUpdater();
        $updater->update($item);

        $this->assertEquals(80, $item->quality);
        $this->assertEquals(10, $item->sellIn);
    }

    public function testUpdateQualityWhenSellInZero()
    {
        $item = new Item();
        $item->sellIn = 0;
        $item->quality = 50;

        $updater = new SamsungGalaxyS23QualityUpdater();
        $updater->update($item);

        $this->assertEquals(80, $item->quality);
        $this->assertEquals(0, $item->sellIn);
    }

    public function testUpdateQualityWhenQualityIsAbove80()
    {
        $item = new Item();
        $item->sellIn = 10;
        $item->quality = 100;

        $updater = new SamsungGalaxyS23QualityUpdater();
        $updater->update($item);

        $this->assertEquals(80, $item->quality);
        $this->assertEquals(10, $item->sellIn);
    }

    public function testUpdateQualityWhenQualityIsLessThan80()
    {
        $item = new Item();
        $item->sellIn = 5;
        $item->quality = 60;

        $updater = new SamsungGalaxyS23QualityUpdater();
        $updater->update($item);

        $this->assertEquals(80, $item->quality);
        $this->assertEquals(5, $item->sellIn);
    }
}
