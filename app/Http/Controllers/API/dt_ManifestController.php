<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\dt_Manifest;
use App\Models\Manifest;
use App\Models\Inventory;

class dt_ManifestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return dt_Manifest::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'manifest_id' => 'required',
            'inventory_id' => 'required',                
            'nama_inventory' => 'required',
            'jumlah_inventory' => 'required',
        ]);

        Inventory::where('id', $request->inventory_id)->decrement('jumlah_inventory', $request->jumlah_inventory);
        
        return dt_Manifest::create([
            'manifest_id' => $request->manifest_id,
            'inventory_id' => $request->inventory_id,
            'nama_inventory' => $request->nama_inventory,
            'jumlah_inventory' => $request->jumlah_inventory,
        ]);
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return dt_Manifest::where('manifest_id',$id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'manifest_id' => 'required|integer',
            'inventory_id' => 'required',            
            'nama_inventory' => 'required',
            'jumlah_inventory' => 'required',
        ]);

              

        $dt_dtManifest=[
            'manifest_id' => $request->manifest_id,
            'inventory_id' => $request->inventory_id,
            'nama_inventory' => $request->nama_inventory,
            'jumlah_inventory' => $request->jumlah_inventory,
        ];

        $nilaidb = Inventory::find($request->inventory_id)->value('jumlah_inventory');
        $nilaidb2 = dt_Manifest::find($id)->value('jumlah_inventory');
        if ($nilaidb2 > $request->jumlah_inventory) {
            $decrement = $request->jumlah_inventory - $nilaidb2;
            Inventory::where('id', $request->inventory_id)->decrement('jumlah_inventory', $decrement);
            // $increment = $nilaidb2 - $request->jumlah_inventory;
            // Inventory::where('id', $request->inventory_id)->increment('jumlah_inventory', $increment);
        } else {
            $increment = $nilaidb2 - $request->jumlah_inventory;
            Inventory::where('id', $request->inventory_id)->increment('jumlah_inventory', $increment);
            // $decrement = $request->jumlah_inventory - $nilaidb2;
            // Inventory::where('id', $request->inventory_id)->decrement('jumlah_inventory', $decrement);
        }

        $ubahData = dt_Manifest::findOrFail($id);
        $ubahData->update($dt_dtManifest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Inventory::where('id', $request->inventory_id)->increment('jumlah_inventory', $request->jumlah_inventory);
        $hapus = dt_Manifest::findOrFail($id);
        $hapus->delete();
    }
}
