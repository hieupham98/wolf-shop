<?php

use PHPUnit\Framework\TestCase;
use App\Models\Item;
use App\Services\XiaomiRedmiNote13QualityUpdater;

class XiaomiRedmiNote13QualityUpdaterTest extends TestCase
{
    public function testUpdateQualityWhenSellInGreaterThanZero()
    {
        $item = new Item();
        $item->sellIn = 5;
        $item->quality = 10;

        $updater = new XiaomiRedmiNote13QualityUpdater();
        $updater->update($item);

        $this->assertEquals(8, $item->quality);
        $this->assertEquals(4, $item->sellIn);
    }

    public function testUpdateQualityWhenSellInIsZero()
    {
        $item = new Item();
        $item->sellIn = 0;
        $item->quality = 10;

        $updater = new XiaomiRedmiNote13QualityUpdater();
        $updater->update($item);

        $this->assertEquals(8, $item->quality);
        $this->assertEquals(-1, $item->sellIn);
    }

    public function testUpdateQualityWhenQualityIsZero()
    {
        $item = new Item();
        $item->sellIn = 5;
        $item->quality = 0;

        $updater = new XiaomiRedmiNote13QualityUpdater();
        $updater->update($item);

        $this->assertEquals(0, $item->quality);
        $this->assertEquals(4, $item->sellIn);
    }

    public function testUpdateQualityDoesNotGoBelowZero()
    {
        $item = new Item();
        $item->sellIn = 0;
        $item->quality = 1;

        $updater = new XiaomiRedmiNote13QualityUpdater();
        $updater->update($item);

        $this->assertEquals(0, $item->quality);
        $this->assertEquals(-1, $item->sellIn);
    }
}
