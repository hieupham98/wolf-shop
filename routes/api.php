<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ImageUploadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['name' => 'api'], function () {
    Route::get('/ping', function() {
        return response()->json([
            'status' => 'pong',
        ]);
    });

    Route::post('/upload-images', [ImageUploadController::class, 'upload']);
    Route::get('/items', [ItemController::class, 'all']);
    Route::post('/items', [ItemController::class, 'createItem']);

    Route::post('/decrease-sellin', [ItemController::class, 'decreaseSellIn']);
    //TODO: write cronjob for auto decreasing SellIn at the end of every single day
});
