@extends('layouts.layout')
@section('title', 'Galerie')
@section('head')
@endsection
@section('content')


 <!-- Zuerst ist bei der Galerie diese Seite zu sehen da noch kein ES ausgewählt wurde, wenn eines ausgewählt wird, dann wird auf die Seite/Blade GalerieES gewechselt  -->

    <body oncontextmenu="return false"> <!-- Rechtsklick auf der Web-Seite nicht möglich -->

         <!-- Drop-Down -->
        <div class="dropdowngalerie">
            <button class="dropbtngalerie"style="font-family: Arial, sans-serif;">Wählen Sie ein Energiesystem aus</button> <!-- Drop-Down Menü der ES -->
            <div class="dropdowngalerie-content">
                <!-- Wird der Inhalt gesetzt -->
                @foreach ($data as $d)
                    <!-- Jedes ES aus der DB wird einzeln in die Liste gespeichert -->
                    <a href="{{ route('EnSys.show', $d->id) }}">{{ $d->designation }}</a>
                @endforeach
            </div>
        </div>


        <!-- Anzeige darunter -->
        <div class="GalerieAnzeige shadow-lg rounded">
            <h3 style="padding:10px; margin-left: 30%;"> <b style="font-family: Arial, sans-serif;">Bitte wählen Sie ein Energiesystem aus </b></h3>
        </div>
    </body>





@endsection
@section('foooter')
