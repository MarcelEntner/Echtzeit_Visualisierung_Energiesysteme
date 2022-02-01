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

        $enTech->save();
        $data = DB::table('EnTech')->get();
//Grafana Panel Erstellen Anfang

/*

$uid = strval($request->IDES);

$panelId = $enTech->id;

$getCurrentDashboard = Http::withToken('eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==')->get('192.168.1.5:3000/api/dashboards/uid/'. $uid);

$oldDashboard = json_decode($getCurrentDashboard,true);




    $paneldef =      [

        'datasource' => [
            'type' => 'datasource',
            'uid' => 'grafana',
        ],
        'fieldConfig' => [
            'defaults' => [
                'color' => [
                    'mode' => 'palette-classic',
                ],
                'custom' => [
                    'axisLabel' => '',
                    'axisPlacement' => 'auto',
                    'barAlignment' => 0,
                    'drawStyle' => 'line',
                    'fillOpacity' => 0,
                    'gradientMode' => 'none',
                    'hideFrom' => [
                        'legend' => false,
                        'tooltip' => false,
                        'viz' => false,
                    ],
                    'lineInterpolation' => 'linear',
                    'lineWidth' => 1,
                    'pointSize' => 5,
                    'scaleDistribution' => [
                        'type' => 'linear',
                    ],
                    'showPoints' => 'auto',
                    'spanNulls' => false,
                    'stacking' => [
                        'group' => 'A',
                        'mode' => 'none',
                    ],
                    'thresholdsStyle' => [
                        'mode' => 'off',
                    ],
                ],
                'mappings' => [],
                'thresholds' => [
                    'mode' => 'absolute',
                    'steps' => [
                        [
                            'color' => 'green',
                            'value' => null,
                        ],
                        [
                            'color' => 'red',
                            'value' => 80,
                        ],
                    ],
                ],
            ],
            'overrides' => [],
        ],
        'gridPos' => [
            'h' => 9,
            'w' => 12,
            'x' => 0,
            'y' => 0,
        ],
        'id' => $panelId,
        'options' => [
            'legend' => [
                'calcs' => [],
                'displayMode' => 'list',
                'placement' => 'bottom',
            ],
            'tooltip' => [
                'mode' => 'single',
            ],
        ],
        'targets' => [
            [
                'datasource' => [
                    'type' => 'datasource',
                    'uid' => 'grafana',
                ],
                'queryType' => 'randomWalk',
                'refId' => 'A',
            ],
        ],
        'title' => $request->Bezeichnung,
        'type' => 'timeseries',
        ];


        $oldPanels = $oldDashboard['dashboard']['panels'];

        array_push($oldPanels, $paneldef);
       
        $oldDashboard['dashboard']['panels'] = $oldPanels;

 

  
    
$createEnsysDashboard = Http::withHeaders([

        

    'Authorization' => 'Bearer eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json',
    
    
    
    
    ])->post('192.168.1.5:3000/api/dashboards/db', $oldDashboard );
    echo($createEnsysDashboard);

*/

//Grafana Panel Erstellen Ende

        



        //Tabellen-Eintrag im richtigen Typ für Echtzeitdaten
        switch ($request->Typ) {
            case "PV-Anlage":
                $Controller = new EtPvController();
                $Controller->store($enTech->id);
                break;

            case "Stromnetzbezug":
                $Controller = new EtSnBController();
                $Controller->store($enTech->id);
                break;

            case "Batteriespeicher":
                $Controller = new EtBsController();
                $Controller->store($enTech->id);
                break;

            case "Wasserstoff Elektrolyse":
                $Controller = new EtWeController();
                $Controller->store($enTech->id);
                break;

            case "Wasserstoff Brennstoffzelle":
                $Controller = new EtBsZController();
                $Controller->store($enTech->id);
                break;

            case "Wasserstoff Speicher":
                $Controller = new EtWsController();
                $Controller->store($enTech->id);
                break;

            case "Windkraftanlage":
                $Controller = new EtWkAController();
                $Controller->store($enTech->id);
                break;

            case "E-Ladestation":
                $Controller = new EtElController();
                $Controller->store($enTech->id);
                break;

            case "Hausanschlusszähler":
                $Controller = new EtHaZController();
                $Controller->store($enTech->id);
                break;

            case "Wärmenetzbezug":
                $Controller = new EtWnBController();
                $Controller->store($enTech->id);
                break;

            case "Biomasseheizkraftwerk":
                $Controller = new EtBhKwController();
                $Controller->store($enTech->id);
                break;

            case "Biomasseheizwerk":
                $Controller = new EtBmHwController();
                $Controller->store($enTech->id);
                break;

            case "Biomasseheizkessel":
                $Controller = new EtBmHkController();
                $Controller->store($enTech->id);
                break;

            case "Wärmespeicher":
                $Controller = new EtWesController();
                $Controller->store($enTech->id);
                break;

            case "Solarthermieanlage":
                $Controller = new EtSthController();
                $Controller->store($enTech->id);
                break;

            case "Wärmepumpe":
                $Controller = new EtWpController();
                $Controller->store($enTech->id);
                break;

            case "Gebäude Wärmebedarfszähler":
                $Controller = new EtGWbZController();
                $Controller->store($enTech->id);
                break;

            case "Kompressionskältemaschine":
                $Controller = new EtKkMController();
                $Controller->store($enTech->id);
                break;

            case "Ab oder Adsorbtionskältemaschine":
                $Controller = new EtAdAbKmController();
                $Controller->store($enTech->id);
                break;

            case "Kältespeicher":
                $Controller = new EtKsController();
                $Controller->store($enTech->id);
                break;

            case "Gebäude Kältebedarfszähler":
                $Controller = new EtGKbZController();
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


        
    

//Grafana Panel Löschen Anfang

/*
$Entech = DB::table('EnTech')->where('id', $id)->first();

$uid = strval($Entech->ensys_id);

$getCurrentDashboard = Http::withToken('eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==')->get('192.168.1.5:3000/api/dashboards/uid/'. $uid);

$oldDashboard = json_decode($getCurrentDashboard,true);


$oldPanels = $oldDashboard['dashboard']['panels'];
       
    
$index = 0;

        foreach($oldPanels as $key => $value)
        {
            if($value['id'] == $id)
            {
                
                break;
            }

            $index++;
        }




unset($oldPanels[$index]);

$oldDashboard['dashboard']['panels'] = $oldPanels;


$deletePanel = Http::withHeaders([

        

    'Authorization' => 'Bearer eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==',
    'Content-Type' => 'application/json',
    'Accept' => 'application/json',
    
    
    
    
    ])->post('192.168.1.5:3000/api/dashboards/db', $oldDashboard );

    echo($deletePanel);

*/

//Grafana Panel Löschen Ende


if ($EnTech == null) {
    dd("Konnte nicht gelöscht werden");
} else {
    $EnTech->delete();
    return redirect('/energiesysteme');
}
    }

}
