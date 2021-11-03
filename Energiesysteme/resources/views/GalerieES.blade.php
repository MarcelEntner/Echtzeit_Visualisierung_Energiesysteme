@extends('layouts.layout')
@section('title','Galerie')
@section('head')
@endsection
@section('content')




<div class="dropdown">
  <button class="dropbtn">Wählen Sie ein Energiesystem aus</button>
  <div class="dropdown-content">
      @foreach ($data as $d)
         <a href="{{route('EnSys.show', $d->id)}}">{{ $d -> Bezeichnung }}</a>  
      @endforeach

   <!-- <a href="#">MicroGridLab</a>
    <a href="#">Feuerwehr</a>-->
  </div>
</div>













<div class="GalerieAnzeige">
  
    <h3 style="padding:10px"> <b> {{$EnSys->Bezeichnung}} Energietechnologien</b></h3>
  
  
  
  </div>

  
 
  


@endsection
@section('foooter')