<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\dt_Manifest;
use App\Models\Manifest;
use App\Models\Inventory;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        $nilaidb2 = dt_Manifest::where('id',$request->id)->value('jumlah_inventory');

        // $this->validate($request, [
        //     'manifest_id' => 'required|integer',
        //     'inventory_id' => 'required',            
        //     'nama_inventory' => 'required',
        //     'jumlah_inventory' => 'required',
        // ]);
              

        $dt_dtManifest=[
            'jumlah_inventory' => 0,
        ];
    
        
        $nilaidata = $request->jumlah_inventory;
        $decrement = $nilaidata - $nilaidb2;
        $increment = $nilaidb2 - $nilaidata;
        // dump($nilaidb2);
        // dump($nilaidata);
        // dump($decrement);
        // dump($increment);        

        if ($nilaidb2 <= $request->jumlah_inventory) {
            Inventory::where('id', $request->inventory_id)->increment('jumlah_inventory', $increment);
        } else {
            Inventory::where('id', $request->inventory_id)->decrement('jumlah_inventory', $decrement);
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
        //
    }
}
