<?php

namespace App\Http\Controllers;

use App\Models\EtWnB;
use Illuminate\Http\Request;

class EtWnBController extends Controller
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
        $EtWnB = new EtWnB();
        $EtWnB->enTech_idEnTech = $id;
        $EtWnB->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtWnB  $etWnB
     * @return \Illuminate\Http\Response
     */
    public function show(EtWnB $etWnB)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtWnB  $etWnB
     * @return \Illuminate\Http\Response
     */
    public function edit(EtWnB $etWnB)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtWnB  $etWnB
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtWnB $etWnB)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtWnB  $etWnB
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtWnB $etWnB)
    {
        //
    }
}
