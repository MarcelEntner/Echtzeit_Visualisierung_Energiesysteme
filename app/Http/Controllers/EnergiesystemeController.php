<?php

namespace App\Http\Controllers;

use App\Models\Energiesysteme;
use Illuminate\Http\Request;

class EnergiesystemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('homepage');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Energiesysteme  $energiesysteme
     * @return \Illuminate\Http\Response
     */
    public function show(Energiesysteme $energiesysteme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Energiesysteme  $energiesysteme
     * @return \Illuminate\Http\Response
     */
    public function edit(Energiesysteme $energiesysteme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Energiesysteme  $energiesysteme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Energiesysteme $energiesysteme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Energiesysteme  $energiesysteme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Energiesysteme $energiesysteme)
    {
        //
    }
}
