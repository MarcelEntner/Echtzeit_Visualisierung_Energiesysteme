<?php

namespace App\Http\Controllers;

use App\Models\EtWp;
use Illuminate\Http\Request;

class EtWpController extends Controller
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
        $EtWp = new EtWp();
        $EtWp->EnTech_id = $id;
        $EtWp->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EtWp  $etWp
     * @return \Illuminate\Http\Response
     */
    public function show(EtWp $etWp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EtWp  $etWp
     * @return \Illuminate\Http\Response
     */
    public function edit(EtWp $etWp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EtWp  $etWp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EtWp $etWp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EtWp  $etWp
     * @return \Illuminate\Http\Response
     */
    public function destroy(EtWp $etWp)
    {
        //
    }
}
