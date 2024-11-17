<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\WolfService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $wolfService;

    public function __construct(WolfService $wolfService)
    {
        $this->wolfService = $wolfService;
    }

    public function updateItems()
    {

        $this->wolfService->updateAllItems();

        return response()->json(['message' => 'Items updated successfully']);
    }
}
