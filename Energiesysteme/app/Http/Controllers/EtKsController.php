<?php

namespace App\Http\Controllers;

use App\Models\EtKs;
use Illuminate\Http\Request;

class EtKsController extends Controller
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
        $EtKs = new EtKs();
        $EtKs->enTech_idEnTech = $id;
        $EtKs->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtKs  $etKs
     * @return \Illuminate\Http\Response
     */
    public function show(EtKs $etKs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtKs  $etKs
     * @return \Illuminate\Http\Response
     */
    public function edit(EtKs $etKs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtKs  $etKs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtKs $etKs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtKs  $etKs
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtKs $etKs)
    {
        //
    }
}
