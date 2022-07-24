<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\LevelController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\LokasiController;
use App\Http\Controllers\API\InventoryController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ambildatalevel',  [LevelController::class, 'index']);

Route::apiResources([
    'user' => UserController::class,
    'kategori' => KategoriController::class,
    'lokasi' => LokasiController::class,
    'inventory' => InventoryController::class,
]);
