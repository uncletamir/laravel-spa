<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inventory::all();
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
            'kategori_id' => 'required|integer',
            'lokasi_id' => 'required|integer',
            'nama_inventory' => 'required',
            'jumlah_inventory' => 'required',
        ]);

        return Inventory::create([
            'kategori_id' => $request->kategori_id,
            'lokasi_id' => $request->lokasi_id,
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
        //
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
            'kategori_id' => 'required|integer',
            'lokasi_id' => 'required|integer',
            'nama_inventory' => 'required',
            'jumlah_inventory' => 'required',
        ]);

        $dtInventory = [
            'kategori_id' => $request->kategori_id,
            'lokasi_id' => $request->lokasi_id,
            'nama_inventory' => $request->nama_inventory,
            'jumlah_inventory' => $request->jumlah_inventory,
        ];

        $ubahData = Inventory::findOrFail($id);
        $ubahData->update($dtInventory);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = Inventory::findOrFail($id);
        $hapus->delete();
    }
}
