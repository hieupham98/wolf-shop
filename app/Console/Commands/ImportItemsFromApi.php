<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Item;
use Illuminate\Support\Facades\Http;

class ImportItemsFromApi extends Command
{
    /**
     *
     * @var string
     */
    protected $signature = 'items:import-from-api';

    protected $description = 'Import items from external API and update Quality if item exists';

    /**
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::get('https://api.restful-api.dev/objects');

        if ($response->successful()) {
            $itemsData = $response->json();

            foreach ($itemsData as $itemData) {
                $item = Item::where('name', $itemData['name'])->first();

                if ($item) {
                    $this->updateItemQuality($item);
                } else {
                    $this->createNewItem($itemData);
                }
            }

            $this->info('Items imported and updated successfully.');
        } else {
            $this->error('Failed to fetch data from API.');
        }
    }

    /**
     *
     * @param \App\Models\Item $item
     * @return void
     */
    protected function updateItemQuality(Item $item)
    {
        $item->quality = 30; 
        $item->save();

        $this->info("Updated Quality for item: {$item->name}");
    }

    /**
     * Tạo mặt hàng mới từ dữ liệu API.
     *
     * @param array $itemData
     * @return void
     */
    protected function createNewItem(array $itemData)
    {
        Item::create([
            'name' => $itemData['name'],
            'sellIn' => rand(1, 30), 
            'quality' => rand(1, 50), 
            'data' => json_encode($itemData['data']),
            'imgUrl' =>  $itemData['imgUrl'] ?? null,
        ]);

        $this->info("Created new item: {$itemData['name']}");
    }
}
