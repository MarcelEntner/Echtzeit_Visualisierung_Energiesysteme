<?php

namespace App\Http\Controllers;

use App\Models\EtWe;
use Illuminate\Http\Request;

class EtWeController extends Controller
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
        $EtWe = new EtWe();
        $EtWe->EnTech_id = $id;
        $EtWe->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtWe  $etWe
     * @return \Illuminate\Http\Response
     */
    public function show(EtWe $etWe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtWe  $etWe
     * @return \Illuminate\Http\Response
     */
    public function edit(EtWe $etWe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtWe  $etWe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtWe $etWe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\etWe  $etWe
     * @return \Illuminate\Http\Response
     */
    public function destroy(etWe $etWe)
    {
        //
    }
}
