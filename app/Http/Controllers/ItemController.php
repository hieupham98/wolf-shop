<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\WolfService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreItemRequest;
use App\Repositories\ItemRepositoryInterface;

class ItemController extends Controller
{
    protected $wolfService;
    protected $itemRepo;

    public function __construct(
        ItemRepositoryInterface $itemRepo,
        WolfService $wolfService
    )
    {
        $this->itemRepo = $itemRepo;
        $this->wolfService = $wolfService;
    }

    public function all(Request $request)
    {
        try {
            $items = $this->itemRepo->getAll($request);

            return response()->json([
                'data' => $items
            ], 201);
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function decreaseSellIn()
    {
        try {
            $this->wolfService->updateAllItems();

            return response()->json(['message' => 'Items updated successfully']);
            
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createItem(StoreItemRequest $request)
    {
        try {
            $validated = $request->validated();

            $item = $this->itemRepo->create($validated);
            
            return response()->json([
                'message' => 'Item created successfully!',
                'item' => $item
            ], 201);
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
