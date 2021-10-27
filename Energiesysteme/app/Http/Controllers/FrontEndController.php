<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        return view('Homepage');
    }

    public function galerie()
    {
        return view('Galerie');
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
