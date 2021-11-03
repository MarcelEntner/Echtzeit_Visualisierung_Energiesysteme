<?php

namespace App\Http\Controllers;

use App\Models\EnSys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnSysController extends Controller
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
    public function store(Request $request)
    {
        $enSys = new EnSys();
        $enSys->Bezeichnung=$request->Bezeichnung;
        $enSys->Katastralgemeinden=$request->Katastralgemeinden;
        $enSys->Postleitzahl=$request->Postleitzahl;
        $enSys->save();
        $data = DB::table('EnSys')->get();
        return view('Energiesysteme', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnSys  $enSys
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $EnSys = EnSys::find($id);
       $data = DB::table('EnSys')->get();


        return view('GalerieES',[
            'EnSys' =>$EnSys, 'data' =>$data

        ]);
       
      // $data = DB::table('EnSys')->get();
       // return view('GalerieES', compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnSys  $enSys
     * @return \Illuminate\Http\Response
     */
    public function edit(EnSys $enSys)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnSys  $enSys
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnSys $enSys)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnSys  $enSys
     * @return \Illuminate\Http\Response
     */
    public function destroy(EnSys $enSys)
    {
        //
    }
}

//