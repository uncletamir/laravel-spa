<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\LevelController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\KategoriController;
use App\Http\Controllers\API\LokasiController;
use App\Http\Controllers\API\InventoryController;
use App\Http\Controllers\API\SearchInventory;
use App\Http\Controllers\API\ManifestController;
use App\Http\Controllers\API\dt_ManifestController;
use App\Http\Controllers\API\PengembalianController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ambildatalevel',  [LevelController::class, 'index']);
Route::get('search', [SearchInventory::class, 'search']);


Route::apiResources([
    'user' => UserController::class,
    'kategori' => KategoriController::class,
    'lokasi' => LokasiController::class,
    'inventory' => InventoryController::class,
    'manifest' => ManifestController::class,
    'detail-manifest' => dt_ManifestController::class,
    'pengembalian-manifest' => PengembalianController::class,
]);
