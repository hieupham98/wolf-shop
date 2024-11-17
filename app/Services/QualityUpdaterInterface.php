<?php

namespace App\Services;

use App\Models\Item;

interface QualityUpdaterInterface
{
    public function update(Item $item): void;
}
