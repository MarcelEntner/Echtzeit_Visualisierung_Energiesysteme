<?php

namespace App\Http\Controllers;

use App\Models\EtBsZ;
use Illuminate\Http\Request;

class EtBsZController extends Controller
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
        $EtBsZ = new EtBsZ();
        $EtBsZ->enTech_idEnTech = $id;
        $EtBsZ->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtBsZ  $etBsZ
     * @return \Illuminate\Http\Response
     */
    public function show(EtBsZ $etBsZ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtBsZ  $etBsZ
     * @return \Illuminate\Http\Response
     */
    public function edit(EtBsZ $etBsZ)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtBsZ  $etBsZ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtBsZ $etBsZ)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtBsZ  $etBsZ
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtBsZ $etBsZ)
    {
        //
    }
}
