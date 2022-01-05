<?php

namespace App\Http\Controllers;

use App\Models\EtSth;
use Illuminate\Http\Request;

class EtSthController extends Controller
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
        $EtSth = new EtSth();
        $EtSth->EnTech_id = $id;
        $EtSth->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtSth  $etSth
     * @return \Illuminate\Http\Response
     */
    public function show(EtSth $etSth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtSth  $etSth
     * @return \Illuminate\Http\Response
     */
    public function edit(EtSth $etSth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtSth  $etSth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtSth $etSth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtSth  $etSth
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtSth $etSth)
    {
        //
    }
}
