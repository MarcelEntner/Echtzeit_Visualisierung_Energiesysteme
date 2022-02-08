<?php

namespace App\Http\Controllers;

use App\Models\EtHaZ;
use Illuminate\Http\Request;

class EtHaZController extends Controller
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
        $EtHaZ = new EtHaZ();
        $EtHaZ->enTech_idEnTech = $id;
        $EtHaZ->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtHaZ  $etHaZ
     * @return \Illuminate\Http\Response
     */
    public function show(EtHaZ $etHaZ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtHaZ  $etHaZ
     * @return \Illuminate\Http\Response
     */
    public function edit(EtHaZ $etHaZ)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtHaZ  $etHaZ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtHaZ $etHaZ)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtHaZ  $etHaZ
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtHaZ $etHaZ)
    {
        //
    }
}
