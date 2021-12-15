@extends('layouts.layout')
@section('title','Galerie')
@section('head')
@endsection
@section('content')




<div class="dropdowngalerie">
    <button class="dropbtngalerie">Wählen Sie ein Energiesystem aus</button>
    <div class="dropdowngalerie-content">
        @foreach ($data as $d)
           <a href="{{route('EnSys.show', $d->id)}}">{{ $d -> Bezeichnung }}</a>  
        @endforeach

     <!-- <a href="#">MicroGridLab</a>
      <a href="#">Feuerwehr</a>-->
    </div>
  </div>




  <div class="GalerieAnzeige shadow-lg rounded">
  
    <h3 style="padding:10px; margin-left: 35%;"> <b>Bitte wählen Sie ein Energiesystem aus </b></h3>
  
  
  
  </div>


 
  


@endsection
@section('foooter')