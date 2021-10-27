<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        return view('LandingPage');
    }

    public function galerie()
    {
        return view('Galerie');
    }

    public function kartendienst()
    {
        return view('Kartendienst');
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
