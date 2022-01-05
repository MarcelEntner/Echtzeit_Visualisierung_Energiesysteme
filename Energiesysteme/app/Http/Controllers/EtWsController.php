<?php

namespace App\Http\Controllers;

use App\Models\EtWs;
use Illuminate\Http\Request;

class EtWsController extends Controller
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
        $EtWs = new EtWs();
        $EtWs->EnTech_id = $id;
        $EtWs->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtWs  $etWs
     * @return \Illuminate\Http\Response
     */
    public function show(EtWs $etWs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtWs  $etWs
     * @return \Illuminate\Http\Response
     */
    public function edit(EtWs $etWs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtWs  $etWs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtWs $etWs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtWs  $etWs
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtWs $etWs)
    {
        //
    }
}
