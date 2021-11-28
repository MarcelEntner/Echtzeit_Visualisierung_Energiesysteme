<?php

namespace App\Http\Controllers;

use App\Models\EnTech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EnTechController extends Controller
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
        $enTech = new EnTech();
        
        $enTech->idES=$request->IDES;
        $enTech->Bezeichnung=$request->Bezeichnung;
        $enTech->Laengengrad=$request->Laengengrad;
        $enTech->Breitengrad=$request->Breitengrad;
        $enTech->Typ=$request->Typ;
        $enTech->Ort=$request->Ort;
        $enTech->save();
        $data = DB::table('EnTech')->get();


        return redirect("/energiesysteme")->with(['data' => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnTech  $enTech
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $EnTech = EnTech::find($id);
        $data = DB::table('EnTech')->get();
 
 
         return view('energiesysteme',[
             'EnTech' =>$EnTech, 'data' =>$data
 
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnTech  $enTech
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
    
        $EnTech = EnTech::find($id);

        $EnTech = EnTech::where('id',$id)->
        update([
                'Laengengrad' => $request->input('LaengengradEditET'),
                'Breitengrad' => $request->input('BreitengradEditET'),
                'Bezeichnung' => $request->input('BezeichnungEditET'),
                'Typ' => $request->input('TypEditET'),
                'Ort' => $request->input('OrtEditET'),
        ]);
      

        return redirect ('/energiesysteme');

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnTech  $enTech
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EnTech $enTech)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnTech  $enTech
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $EnTech = EnTech::find($id);

        
        if ($EnTech == null){
            dd("Konnte nicht gelöscht werden");
        }

        else {
          $EnTech->delete();
         return redirect ('/energiesysteme');
         }
    }
}
