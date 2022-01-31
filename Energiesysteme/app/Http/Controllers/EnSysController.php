<?php

namespace App\Http\Controllers;

use App\Models\EnSys;
use App\Models\EnTech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $enSys->Bezeichnung = $request->BezeichnungES;
        $enSys->Laengengrad = $request->LaengengradES;
        $enSys->Breitengrad = $request->BreitengradES;
        $enSys->Katastralgemeinden = $request->KatastralgemeindenES;
        $enSys->Postleitzahl = $request->PostleitzahlES;
        $enSys->user_id = $user->id;
        $enSys->save();
        $data = DB::table('EnSys')->get();


        // Hier beginnt der Grafana Zugriff für Dashboard Erstellen

        
/*
        $uid = strval($enSys->id);

        $createEnsysDashboard = Http::withHeaders([


            'Authorization' => 'Bearer eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',

        ])->post('192.168.1.5:3000/api/dashboards/db', [


            "dashboard" => [


                'annotations' => [
                    'list' => [
                        [
                            'builtIn' => 1,
                            'datasource' => '-- Grafana --',
                            'enable' => true,
                            'hide' => true,
                            'iconColor' => 'rgba(0, 211, 255, 1)',
                            'name' => 'Annotations & Alerts',
                            'target' => [
                                'limit' => 100,
                                'matchAny' => false,
                                'tags' => [],
                                'type' => 'dashboard',
                            ],
                            'type' => 'dashboard',
                        ],
                    ],
                ],
                'editable' => true,
                'fiscalYearStartMonth' => 0,
                'graphTooltip' => 0,
                'id' => null,
                'links' => [],
                'liveNow' => false,
                'panels' => [
                    [
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
                        'id' => 2,
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
                        'title' => 'paneltest',
                        'type' => 'timeseries',
                    ],
                ],
                'refresh' => '',
                'schemaVersion' => 16,
                'style' => 'dark',
                'tags' => [],
                'templating' => [
                    'list' => [],
                ],
                'time' => [
                    'from' => 'now-6h',
                    'to' => 'now',
                ],
                'timepicker' => [],
                'timezone' => 'browser',
                'title' => $request->BezeichnungES,
                'uid' => $uid,
                'version' => 0,
               
        
                ]
        ]);

        echo ($createEnsysDashboard);
*/

        
        // Grafana Ende





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
        //$EnTech = DB::table('EnTech')->get();
        $EnTech = EnTech::where('ensys_id', $id)->get();




        return view('GalerieES', compact('EnSys', 'data', 'EnTech'));

        // $data = DB::table('EnSys')->get();
        // return view('GalerieES', compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnSys  $enSys
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $EnSys = EnSys::find($id);

        $EnSys = EnSys::where('id', $id)->update([
            'Laengengrad' => $request->input('Laengengrad'),
            'Breitengrad' => $request->input('Breitengrad'),
            'Bezeichnung' => $request->input('Bezeichnung'),
            'Katastralgemeinden' => $request->input('Katastralgemeinden'),
            'Postleitzahl' => $request->input('Postleitzahl'),
        ]);


        return redirect('/energiesysteme');
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



        // Hier beginnt der Grafana Zugriff für Dashboard löschen
        /*
        $strid = strval($id);


        $address = '192.168.1.5:3000/api/dashboards/uid/';


        $url = $address . $strid;

        $deleteEnsysDashboard = Http::withHeaders([

            'Authorization' => 'Bearer eyJrIjoiM2dTZlU5bTM2SzJPaEt3OExnUUE5eDlFR1NEdjVjSVkiLCJuIjoiVGVzdEtleSIsImlkIjoxfQ==',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',

        ])->delete($url);



        echo ($deleteEnsysDashboard);
*/

        //Grafana Ende 

         






        $EnSys = EnSys::find($id);


        if ($EnSys == null) {
            dd("Konnte nicht gelöscht werden");
        } else {
            $EnSys->delete();
            $EnTech = EnTech::where('ensys_id', $id)->delete();
            return redirect('/energiesysteme');
        }

    }
}

//