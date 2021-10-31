<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FrontEndController extends Controller
{
    public function index()
    {
        return view('Homepage');
    }

    public function galerie()
    {
        $data = DB::table('EtBs')->get();


        return view('Galerie' , compact('data'));
    }

    public function energiesysteme()
    {
        return view('Energiesysteme');
    }
    public function impressum()
    {
        return view('Impressum');
    }
    public function dsgvo()
    {
        return view('Dsgvo');
    }


}
