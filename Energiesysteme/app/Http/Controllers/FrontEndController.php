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
        //Tabellen Ensys & EnTech
        $data = DB::table('EnSys')->get();
        $dataEnTech = DB::table("EnTech")->get();

        //Tabellen der Echtzeitdaten
        $etadabkm = DB::table("etadabkm")->get();
        $etbhkw = DB::table("etbhkw")->get();
        $etbmhk = DB::table("etbmhk")->get();
        $etbmhw = DB::table("etbmhw")->get();
        $etbs = DB::table("etbs")->get();
        $etbsz = DB::table("etbsz")->get();
        $etel = DB::table("etel")->get();
        $etgkbz = DB::table("etgkbz")->get();
        $etgwbz = DB::table("etgwbz")->get();
        $ethaz = DB::table("ethaz")->get();
        $etkkm = DB::table("etkkm")->get();
        $etks = DB::table("etks")->get();
        $etpv = DB::table("etpv")->get();
        $etsnb = DB::table("etsnb")->get();
        $etsth = DB::table("etsth")->get();
        $etwe = DB::table("etwe")->get();
        $etwes = DB::table("etwes")->get();
        $etwka = DB::table("etwka")->get();
        $etwnb = DB::table("etwnb")->get();
        $etwp = DB::table("etwp")->get();
        $etws = DB::table("etws")->get();

        //Alle Daten an die View übergeben
        return view('Energiesysteme' , compact(
              'data'
            , 'dataEnTech'
            , 'etadabkm'
            , 'etbhkw'
            , 'etbmhk'
            , 'etbmhw'
            , 'etbs'
            , 'etbsz'
            , 'etel'
            , 'etgkbz'
            , 'etgwbz'
            , 'ethaz'
            , 'etkkm'
            , 'etks'
            , 'etpv'
            , 'etsnb'
            , 'etsth'
            , 'etwe'
            , 'etwes'
            , 'etwka'
            , 'etwnb'
            , 'etwp'
            , 'etws'
        ));
        
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
