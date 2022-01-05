<?php

namespace App\Http\Controllers;

use App\Models\EtGWbZ;
use Illuminate\Http\Request;

class EtGWbZController extends Controller
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
        $EtGWbZ = new EtGWbZ();
        $EtGWbZ->EnTech_id = $id;
        $EtGWbZ->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtGWbZ  $etGWbZ
     * @return \Illuminate\Http\Response
     */
    public function show(EtGWbZ $etGWbZ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtGWbZ  $etGWbZ
     * @return \Illuminate\Http\Response
     */
    public function edit(EtGWbZ $etGWbZ)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtGWbZ  $etGWbZ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtGWbZ $etGWbZ)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtGWbZ  $etGWbZ
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtGWbZ $etGWbZ)
    {
        //
    }
}
