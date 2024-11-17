<?php

namespace App\Repositories;

use App\Models\Item;
use Illuminate\Http\Request;


class ItemRepository implements ItemRepositoryInterface
{

    public function create(array $data)
    {
        return Item::create($data);
    }

    public function getAll(Request $request)
    {
        return Item::all();
    }
}
