<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Item;

interface ItemRepositoryInterface
{
    public function getAll(Request $request);
    public function create(array $data);
}
