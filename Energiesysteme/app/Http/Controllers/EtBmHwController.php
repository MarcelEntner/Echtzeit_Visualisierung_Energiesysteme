<?php

namespace App\Http\Controllers;

use App\Models\EtBmHw;
use Illuminate\Http\Request;

class EtBmHwController extends Controller
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
        $EtBmHw = new EtBmHw();
        $EtBmHw->enTech_idEnTech = $id;
        $EtBmHw->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtBmHw  $etBmHw
     * @return \Illuminate\Http\Response
     */
    public function show(EtBmHw $etBmHw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtBmHw  $etBmHw
     * @return \Illuminate\Http\Response
     */
    public function edit(EtBmHw $etBmHw)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtBmHw  $etBmHw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtBmHw $etBmHw)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtBmHw  $etBmHw
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtBmHw $etBmHw)
    {
        //
    }
}
