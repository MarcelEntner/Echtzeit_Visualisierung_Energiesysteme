<?php

namespace App\Http\Controllers;

use App\Models\EtPv;
use Illuminate\Http\Request;


class EtPvController extends Controller
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
        $EtPv = new EtPv();
        $EtPv->enTech_idEnTech = $id;
        $EtPv->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtPv  $etPv
     * @return \Illuminate\Http\Response
     */
    public function show(EtPv $etPv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtPv  $etPv
     * @return \Illuminate\Http\Response
     */
    public function edit(EtPv $etPv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtPv  $etPv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtPv $etPv)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtPv  $etPv
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtPv $etPv)
    {
        //
    }
}
