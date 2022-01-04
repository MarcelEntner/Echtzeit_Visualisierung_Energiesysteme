<?php

namespace App\Http\Controllers;

use App\Models\EnTech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;



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

/*

        
*/


        $user = Auth::user();

        $enTech = new EnTech();

        $enTech->ensys_id = $request->IDES;
        $enTech->Bezeichnung = $request->Bezeichnung;
        $enTech->Laengengrad = $request->Laengengrad;
        $enTech->Breitengrad = $request->Breitengrad;
        $enTech->Beschreibung = $request->BeschreibungET;
        $enTech->Typ = $request->Typ;
        $enTech->Ort = $request->Ort;
        $enTech->user_id = $user->id;

        if ($request->file("imageET")) {
            $image = base64_encode(file_get_contents($request->file('imageET')));
            $enTech->Bild = $image;
        }



 /*

//Grafana Anfang
        $uid = strval($request->IDES+1);
       
        $updateDashboardToAddPanel = Http::withHeaders([
            'Authorization' => 'Bearer eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',

        ])->post('192.168.1.5:3000/api/dashboards/db', [
            "dashboard" => [
                "id" => null,
                "uid" => null,
                "title" => $request->Bezeichnung,
                  "tags" => [
                 "templated" 
                   ], 
                "timezone" => "browser",
                "schemaVersion" => 16,
                "version" => 0
            ],
            "folderId" => 0,
            "overwrite" => false
        ]);

        echo($updateDashboardToAddPanel);
// Um dashboard zu updaten -> vorhandenes Dashboard laden -> gesammten inhalt speichern 
//-> vorhandenes dashboard updaten / überschreiben -> gespeichertes einfügen --> update mit post methode posten --> PROFIT
        */
        //Grafana ende
        $enTech->save();
        $data = DB::table('EnTech')->get();



        //Tabellen-Eintrag im richtigen Typ für Echtzeitdaten
        switch ($request->Typ){
            case "PV-Anlage":
                    $Controller = new EtPvController();
                    $Controller->store($enTech->id);
                break;




        }


 



        return redirect("/energiesysteme")->with(['data' => $data]);


        // Http Request für Dashboard Updaten um Panels zu Adden



        // Get key of Ensys ie. uid of panel





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


        return view('energiesysteme', [
            'EnTech' => $EnTech, 'data' => $data

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnTech  $enTech
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $EnTech = EnTech::find($id);

        $EnTech = EnTech::where('id', $id)->update([
                'Laengengrad' => $request->input('LaengengradEditET'),
                'Breitengrad' => $request->input('BreitengradEditET'),
                'Bezeichnung' => $request->input('BezeichnungEditET'),
                'Typ' => $request->input('TypEditET'),
                'Ort' => $request->input('OrtEditET'),
            ]);


        return redirect('/energiesysteme');
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


        if ($EnTech == null) {
            dd("Konnte nicht gelöscht werden");
        } else {
            $EnTech->delete();
            return redirect('/energiesysteme');
        }
    }
}
