<?php

namespace App\Http\Controllers;

use App\Models\EtBs;
use Illuminate\Http\Request;
use DB;

class EtBsController extends Controller
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
        $EtBs = new EtBs();
        $EtBs->enTech_idEnTech = $id;
        $EtBs->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtBs  $etBs
     * @return \Illuminate\Http\Response
     */
    public function show(EtBs $etBs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtBs  $etBs
     * @return \Illuminate\Http\Response
     */
    public function edit(EtBs $etBs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtBs  $etBs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtBs $etBs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtBs  $etBs
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtBs $etBs)
    {
        //
    }
}
