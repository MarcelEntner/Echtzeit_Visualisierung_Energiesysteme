<?php

namespace App\Http\Controllers;

use App\Models\EtBmHk;
use Illuminate\Http\Request;

class EtBmHkController extends Controller
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
        $EtBmHk = new EtBmHk();
        $EtBmHk->enTech_idEnTech = $id;
        $EtBmHk->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtBmHk  $etBmHk
     * @return \Illuminate\Http\Response
     */
    public function show(EtBmHk $etBmHk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtBmHk  $etBmHk
     * @return \Illuminate\Http\Response
     */
    public function edit(EtBmHk $etBmHk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtBmHk  $etBmHk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtBmHk $etBmHk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtBmHk  $etBmHk
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtBmHk $etBmHk)
    {
        //
    }
}
