<?php

namespace App\Http\Controllers;

use App\Models\EtEl;
use Illuminate\Http\Request;

class EtElController extends Controller
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
        $EtEl = new EtEl();
        $EtEl->enTech_idEnTech = $id;
        $EtEl->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtEl  $etEl
     * @return \Illuminate\Http\Response
     */
    public function show(EtEl $etEl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtEl  $etEl
     * @return \Illuminate\Http\Response
     */
    public function edit(EtEl $etEl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtEl  $etEl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtEl $etEl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtEl  $etEl
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtEl $etEl)
    {
        //
    }
}
