<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manifest;

class ManifestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Manifest::all();
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
            'nama_event' => 'required',
            'alamat_event' => 'required',
            'tanggal_event' => 'required',
            'penanggung_jawab' => 'required',            
        ]);

        return Manifest::create([
            'nama_event' => $request->nama_event,
            'alamat_event' => $request->alamat_event,
            'tanggal_event' => $request->tanggal_event,
            'penanggung_jawab' => $request->penanggung_jawab,
            'note'=> $request->note,            
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
            'nama_event' => 'required',
            'alamat_event' => 'required',
            'tanggal_event' => 'required',
            'penanggung_jawab' => 'required',            
        ]);

        $dtManifest = [
            'nama_event' => $request->nama_event,
            'alamat_event' => $request->alamat_event,
            'tanggal_event' => $request->tanggal_event,
            'penanggung_jawab' => $request->penanggung_jawab,
            'note'=> $request->note,
            'status'=> $request->status,
        ];

        $ubahData = Manifest::findOrFail($id);
        $ubahData->update($dtManifest);
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
