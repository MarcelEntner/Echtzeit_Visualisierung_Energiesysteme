<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use stdClass;

class FrontEndController extends Controller
{
    public function index()
    {
        return view('Homepage');
    }

    public function galerie()
    {
        $data = DB::table('EnSys')->get();


        return view('Galerie' , compact('data'));
    }

    public function energiesysteme()
    {
        $data = DB::table('EnSys')->get();
        $dataEnTech = DB::table("EnTech")->get();
        
        $pvanlage = DB::table("etpv")->get();
        $windkraftanlage = DB::table("etwka")->get();

        return view('Energiesysteme' , compact('data', 'dataEnTech','pvanlage', 'windkraftanlage'));
        
    }

    public function impressum()
    {
        return view('Impressum');
    }

    public function dsgvo()
    {
        return view('Dsgvo');
    }

    public function addes()
    {
        $data = DB::table('EnSys')->get();


        return view('addes' , compact('data'));
    }

    public function test(){
        $data = DB::table('EnSys')->get();

        return view('test' , compact('data'));

    }
    


}
