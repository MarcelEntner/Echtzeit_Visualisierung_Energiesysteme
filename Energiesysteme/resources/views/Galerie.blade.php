@extends('layouts.layout')
@section('title', 'Galerie')
@section('head')
@endsection
@section('content')


 <!-- Zuerst ist bei der Galerie diese Seite zu sehen da noch kein ES ausgewählt wurde, wenn eines ausgewählt wird, dann wird auf die Seite/Blade GalerieES gewechselt  -->

    <body oncontextmenu="return false"> <!-- Rechtsklick auf der Web-Seite nicht möglich -->

         <!-- Drop-Down -->
        <div class="dropdowngalerie">
            <button class="dropbtngalerie" style="font-family: 'Hubballi', cursive;  font-size:20px; font-weight:500;">Wählen Sie ein Energiesystem aus</button> <!-- Drop-Down Menü der ES -->
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
            <h3 style="font-family: 'Smooch Sans', sans-serif; text-align:center;">Bitte wählen Sie ein Energiesystem aus</h3>
        </div>
    </body>





@endsection
@section('foooter')
