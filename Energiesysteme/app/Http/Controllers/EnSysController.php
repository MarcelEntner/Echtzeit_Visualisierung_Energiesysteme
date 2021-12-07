<?php

namespace App\Http\Controllers;

use App\Models\EnSys;
use App\Models\EnTech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $user = Auth::user();
       
        $enSys = new EnSys();
        $enSys->Bezeichnung=$request->BezeichnungES;
        $enSys->Laengengrad=$request->LaengengradES;
        $enSys->Breitengrad=$request->BreitengradES;
        $enSys->Katastralgemeinden=$request->KatastralgemeindenES;
        $enSys->Postleitzahl=$request->PostleitzahlES;
        $enSys->user_id=$user->id;
        $enSys->save();
        $data = DB::table('EnSys')->get();



        

        


        return redirect("/energiesysteme")->with(['data' => $data]);
        /*return view('Energiesysteme', compact('data'));*/
       
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
    public function edit(Request $request,$id)
    {
    
        $EnSys = EnSys::find($id);

        $EnSys = EnSys::where('id',$id)->
        update([
                'Laengengrad' => $request->input('Laengengrad'),
                'Breitengrad' => $request->input('Breitengrad'),
                'Bezeichnung' => $request->input('Bezeichnung'),
                'Katastralgemeinden' => $request->input('Katastralgemeinden'),
                'Postleitzahl' => $request->input('Postleitzahl'),
        ]);
      

        return redirect ('/energiesysteme');

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnSys  $enSys
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnSys  $enSys
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $EnSys = EnSys::find($id);

        
        if ($EnSys == null){
            dd("Konnte nicht gelöscht werden");
        }

        else {
          $EnSys->delete();
          $EnTech = EnTech::where('ensys_id', $id)->delete();
         return redirect ('/energiesysteme');
         }

    
           
    
         
        
    }
}

//