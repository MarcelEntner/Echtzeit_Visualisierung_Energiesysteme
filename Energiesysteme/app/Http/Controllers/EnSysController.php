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
        $enSys->designation = $request->BezeichnungES;
        $enSys->longitude = $request->LaengengradES;
        $enSys->latitude = $request->BreitengradES;
        $enSys->localPart = $request->KatastralgemeindenES;
        $enSys->postalCode = $request->PostleitzahlES;
        $enSys->users_idusers = $user->id;
        $enSys->save();
        $data = DB::table('EnSys')->get();


//Grafana Dashboard Erstellen anfang


       
        $uid = strval($enSys->id);

        $createEnsysDashboard = Http::withHeaders([


            'Authorization' => 'Bearer eyJrIjoiQjFpUjQyZnF6U2xFM0hLb1djbjNLaWlLSVBNYXFxelMiLCJuIjoiTWljcm9ncmlkIFZpc3UiLCJpZCI6NH0=',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',

        ])->post('https://show.microgrid-lab.eu/api/dashboards/db', [


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

        
//Grafana Dashboard Erstellen Ende

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
        $EnTech = EnTech::where('enSys_idEnSys', $id)->get();




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
            'longitude' => $request->input('Laengengrad'),
            'latitude' => $request->input('Breitengrad'),
            'designation' => $request->input('Bezeichnung'),
            'localPart' => $request->input('Katastralgemeinden'),
            'postalCode' => $request->input('Postleitzahl'),
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
       
   
        
        //Grafana Dashboard Löschen anfang

    

        $strid = strval($id);


        $address = 'https://show.microgrid-lab.eu/api/dashboards/uid/';


        $url = $address . $strid;

        $deleteEnsysDashboard = Http::withHeaders([

            'Authorization' => 'Bearer eyJrIjoiQjFpUjQyZnF6U2xFM0hLb1djbjNLaWlLSVBNYXFxelMiLCJuIjoiTWljcm9ncmlkIFZpc3UiLCJpZCI6NH0=',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',

        ])->delete($url);



        echo ($deleteEnsysDashboard);

         //Grafana Dashboard löschen ende






        $EnSys = EnSys::find($id);


        if ($EnSys == null) {
            dd("Konnte nicht gelöscht werden");
        } else {
            $EnSys->delete();
            $EnTech = EnTech::where('enSys_idEnSys', $id)->delete();
            return redirect('/energiesysteme');
        }



    }
}

//