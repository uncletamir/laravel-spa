<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;

class SearchInventory extends Controller
{
    public function search(Request $request)
    {
        $inventory = Inventory::where('id',$request->keywords)->get();
        return response()->json($inventory);
    }
}
