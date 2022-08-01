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
            'manifest_id' => 'required|integer',
            'inventory_id' => 'required',                
            'nama_inventory' => 'required',
            'jumlah_inventory' => 'required',
        ]);

        return Inventory::create([
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

        $ubahData = Manifest::findOrFail($id);
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
        $hapus = Manifest::findOrFail($id);
        $hapus->delete();
    }
}
