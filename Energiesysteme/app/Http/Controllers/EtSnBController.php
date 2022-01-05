<?php

namespace App\Http\Controllers;

use App\Models\EtSnB;
use Illuminate\Http\Request;

class EtSnBController extends Controller
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
        $EtSnB = new EtSnB();
        $EtSnB->EnTech_id = $id;
        $EtSnB->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtSnB  $etSnB
     * @return \Illuminate\Http\Response
     */
    public function show(EtSnB $etSnB)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtSnB  $etSnB
     * @return \Illuminate\Http\Response
     */
    public function edit(EtSnB $etSnB)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtSnB  $etSnB
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtSnB $etSnB)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtSnB  $etSnB
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtSnB $etSnB)
    {
        //
    }
}
