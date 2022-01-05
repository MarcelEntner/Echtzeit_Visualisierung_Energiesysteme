<?php

namespace App\Http\Controllers;

use App\Models\EtGKbZ;
use Illuminate\Http\Request;

class EtGKbZController extends Controller
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
    public function store(int $id)
    {
        $EtGKbZ = new EtGkbZ();
        $EtGKbZ->EnTech_id = $id;
        $EtGKbZ->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtGKbZ  $etGKbZ
     * @return \Illuminate\Http\Response
     */
    public function show(EtGKbZ $etGKbZ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtGKbZ  $etGKbZ
     * @return \Illuminate\Http\Response
     */
    public function edit(EtGKbZ $etGKbZ)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtGKbZ  $etGKbZ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtGKbZ $etGKbZ)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtGKbZ  $etGKbZ
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtGKbZ $etGKbZ)
    {
        //
    }
}
